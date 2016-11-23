# PHP FTP Delete by www.scriptol.com 
# Delete a file on a remote server

include "path.sol"
include "ftp.sol"

text server = ""    // The ftp address
text user = ""      // login
text pass = ""      // password

int connection = 0  // handler
int counter         // Number of files deleted
int problem

boolean syncConnect()
	connection = ftp_connect(server)
	if connection = 0 let die("Not connected")
	if ftp_login(connection, user, pass) = true
		print "Connected on $server as $user"
		if ftp_pasv(connection, true) = true
		  	print "Passive mode turned on"
		else
			print "Enable to set passive mode"
		/if    
		return true
	else	
		print "Enable to connect as $user on $server"
	/if
return false

void syncDisconnect()
	ftp_close(connection)
return

void syncDelete(text fname)
  boolean x = @ftp_delete(connection, fname)
  if x = true
    print fname, "deleted"
    counter + 1
  else
    print "Enable to delete", fname  
    problem + 1
  /if  
return  

// Parsing command line parameters
// Stored into an array to overcome problems with PHP's global variables

int main(int argc, array argv)

    array x = argv[ 1 .. ]
	
    problem = 0
    counter = 0
    text remotedir = ""
    
    input "Server (ex. ftp.domain.com): ", server
    input "Remote directory and filename: (ex: www/filename.html) ' ", remotedir
    input "Login: ", user
    input "Password: ", pass

    syncConnect()
    print "Deleting $remotedir"
    syncDelete(remotedir)
    syncDisconnect()
	
    print counter, "file" + plural(counter), "deleted."
    if problem > 0 print "$problem file" + plural(problem) , "skipped."
	
return 0

main($argc, $argv)
