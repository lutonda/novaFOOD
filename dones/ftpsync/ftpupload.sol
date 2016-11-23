include "ftp.sol"

/**
 * Upload.sol - Freeware from scriptol.com 
 * Demo of ftp in Scriptol 
 * Upload a file from a server
 *  
 * Usage:
 * solp upload location filename [ login password ]
 *  
 *  location: example: ftp.domainxxx.com
 *  filename: any file on the server with the path
 *  login: your login for the ftp access of your website
 *  password: your password for your ftp access
 *  
 *  Values missed at command line will be prompted by the program.
 *  If a value is omitted, next parameters must be also.
 *  
 *  Warning: Take care to use the FTP_BINARY flag for a binary file such as image.         
 */   


print $argc, $argv

if ($argc < 2) or ($argc > 6)
  die("Syntax solp ftpupload [server fname remotedir login password]")
/if  

text server = "" 
text fname = ""
text user = ""
text pass = ""
text remotedir = ""

if $argc > 1
  server = $argv[1]
  if $argc > 2
    fname = $argv[2] 
    if $argc > 3
      remotedir = $argv[3]
      if $argc > 4  
        user = $argv[4] 
        if $argc > 5
            pass = $argv[5]
        /if
      /if  
    /if  
  /if 
/if

if server = nil input "Enter server (ex. ftp.domain.tld",  server
if server = nil let exit(0)

if fname = nil input "Enter file",  fname
if fname = nil let exit(0)

if fname = nil input "Enter remore directory (default www/)",  remotedir
if remotedir = nil let remotedir="www/"

if user = nil input "Enter login",  user
if user = nil let exit(0)

if pass = nil input "Password", pass
if pass = nil let exit(0)


print "Connecting to $server"
int cnx = ftp_connect(server)

print "Login $user"
boolean res = ftp_login(cnx, user, pass)
if res = false let die("Error, $user unknown or bad password")

if  ftp_chdir(cnx, remotedir) = true
    print "Now in" , ftp_pwd(cnx), "dir" 
else 
     print "Dir unchanged"
/if

print "Sending $fname"
if ftp_put(cnx, basename(fname), fname, $(FTP_ASCII)) = true 
  print "$fname uploaded"
else 
  print "Can't upload $fname"
/if

ftp_close(cnx)

 
