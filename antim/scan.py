#!/usr/bin/env python
# encoding: utf-8

import sys
import os
import re
import yara
import subprocess
import socket
import sqlite3
from time import localtime, strftime
from hashlib import md5
from optparse import OptionParser


# configuration information to use when processing the 
# various AV products
yara_conf_file = "magic.yara"
yara_packer_file = "packer.yara"
path_to_ssdeep = "/usr/bin/ssdeep"
path_to_clamscan = "/usr/bin/clamscan"
ssdeep_params = '-l'

def md5sum(data):
	m = md5()
	m.update(data)
	return ({'name': 'md5', 'result': m.hexdigest()})

def ssdeep(fname):
	if os.path.isfile(path_to_ssdeep):
		output = subprocess.Popen([path_to_ssdeep, ssdeep_params, fname], stdout=subprocess.PIPE).communicate()[0]
		response = output.split()[1].split(',')[0]
	else:
		response = 'ERROR - SSDEEP Does Not Exist'
	return ({'name': 'ssdeep', 'result': response})

def yarascan(data2):
	if os.path.isfile(yara_conf_file):
		rules = yara.compile(yara_conf_file)
		result = rules.match(data=data2)
		out = ''
		for m in result:
			out += "'%s' " % m
		response = out
	else:
		response = "ERROR - YARA Config Missing"
	return ({'name': 'yara', 'result': response })

def yara_packer(data2):
	if os.path.isfile(yara_packer_file):
		rules = yara.compile(yara_packer_file)
		result = rules.match(data=data2)
		out = ''
		for m in result:
			out += "'%s' " % m
		response = out
	else:
		response = "ERROR - YARA Config Missing"
	return ({'name': 'yara_packer', 'result': response })

def clamscan(fname):
	if os.path.isfile(path_to_clamscan):
		output = subprocess.Popen([path_to_clamscan, fname], stdout = subprocess.PIPE).communicate()[0]
		result = output.split('\n')[0].split(': ')[1]
	else:
		result = 'ERROR - %s not found' % path_to_clamscan
	return ({'name':'clamav', 'result': result})
	
def cymruscan(data):
	# this scanner works by sending a request to hash.cymru.com
        md5 = md5sum(data)
        md5 = md5['result']
        request = '%s\r\n' % md5
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        try:
            s.connect(('hash.cymru.com', 43))
            s.send('begin\r\n')
            s.recv(1024)
            s.send(request)
            response = s.recv(1024)
            s.send('end\r\n')
            s.close()
            if len(response) > 0:
                resp_re = re.compile('\S+ (\d+) (\S+)')
                match = resp_re.match(response)
                response = "%s - %s" % (strftime("%a, %d %b %Y %H:%M:%S", localtime(int(match.group(1)))), match.group(2))
        except socket.error:
            response = "ERROR - NOT AVAILABLE"
        return ({'name': 'cymru_hash_db', 'result': response})
        
def filesize(data):
	return ({'name': 'filesize', 'result': str(len(data))})
	
def filename(filename):
	return({'name': 'filename', 'result': filename})

def insert_db_signature(md5,filename,filesize):
        conn = sqlite3.connect("/antim/db/antim.db")
        cursor = conn.cursor()
        cursor.execute("INSERT INTO signatures (md5,filename,filesize,timestamp) VALUES(?,?,?,datetime(CURRENT_TIMESTAMP,'localtime'))", (md5, filename, filesize))
        conn.commit()
        conn.close()

def select_db_signature(md5):
        conn = sqlite3.connect("/antim/db/antim.db")
        cursor = conn.cursor()
        cursor.execute ("SELECT * FROM signatures WHERE md5 = '%s'" % md5)
        if cursor.fetchone() is None:
            conn.close()
            return False
        conn.close()
        return True


def main():
	parser = OptionParser()
	parser.add_option("-f", "--file", action="store", dest="filename",
	             type="string", help="scanned FILENAME")
	parser.add_option("-v", "--verbose", action="store_true", default=False,
					dest="verbose", help="verbose")

	(opts, args) = parser.parse_args()

	if opts.filename == None:
		parser.print_help()
		parser.error("You must supply a filename!")
	if not os.path.isfile(opts.filename):
		parser.error("%s does not exist" % opts.filename)
		
	data = open(opts.filename, 'rb').read()
	results = []
	results.append(filename(opts.filename))
	results.append(filesize(data))
	results.append(md5sum(data))
	results.append(ssdeep(opts.filename))
	results.append(clamscan(opts.filename))
	results.append(yarascan(data))
	results.append(yara_packer(data))
        results.append(cymruscan(data))

	if opts.verbose:
		print "[+] Using YARA signatures %s" % yara_conf_file
		print "[+] Using ClamAV signatures %s" % clam_conf_file
		print "\r\n"
	for result in results:
		if ("ERROR" in result['result']) and (opts.verbose == False):
			continue
	        print "%20s\t%-s" % (result['name'],result['result'])

        #Insert into the Database
        if not select_db_signature(results[2]['result']):
            insert_db_signature(results[2]['result'], results[0]['result'], results[1]['result'])

	print "\r\n "

if __name__ == '__main__':
	main()

