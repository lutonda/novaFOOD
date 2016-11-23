<?php
// PHP FTP Delete by www.scriptol.com
// Delete a file on a remote server
include_once("path.php");
include_once("ftp.php");
$server="";
$user="";
$pass="";
$connection=0;
$counter=0;
$problem=0;
function syncConnect()
{
   global $connection;
   global $server;
   $connection=ftp_connect($server);
   if($connection===0)
   {
      die("Not connected");
   }
   global $user;
   global $pass;
   if(ftp_login($connection,$user,$pass)===true)
   {
      echo "Connected on $server as $user", "\n";
      if(ftp_pasv($connection,true)===true)
      {
         echo "Passive mode turned on", "\n";
      }
      else
      {
         echo "Enable to set passive mode", "\n";
      }
      return true;
   }
   else
   {
      echo "Enable to connect as $user on $server", "\n";
   }
   return false;
}

function syncDisconnect()
{
   global $connection;
   ftp_close($connection);
   return;
}

function syncDelete($fname)
{
   global $connection;
   $x=@ftp_delete($connection,$fname);
   if($x===true)
   {
      echo $fname, " ", "deleted", "\n";
      global $counter;
      $counter+=1;
   }
   else
   {
      echo "Enable to delete", " ", $fname, "\n";
      global $problem;
      $problem+=1;
   }
   return;
}

function main($argc,$argv)
{
   $x=array_slice($argv,1);
   global $problem;
   $problem=0;
   global $counter;
   $counter=0;
   $remotedir="";
   global $server;
      echo "Server (ex. ftp.domain.com): ";
   $fp=fopen("php://stdin","r");
   $server=rtrim(fgets($fp,65536));
   fclose($fp);
      echo "Remote directory and filename: (ex: www/filename.html) ' ";
   $fp=fopen("php://stdin","r");
   $remotedir=rtrim(fgets($fp,65536));
   fclose($fp);
   global $user;
      echo "Login: ";
   $fp=fopen("php://stdin","r");
   $user=rtrim(fgets($fp,65536));
   fclose($fp);
   global $pass;
      echo "Password: ";
   $fp=fopen("php://stdin","r");
   $pass=rtrim(fgets($fp,65536));
   fclose($fp);
   syncConnect();
   echo "Deleting $remotedir", "\n";
   syncDelete($remotedir);
   syncDisconnect();
   echo $counter, " ", "file".($counter>1?"s":""), " ", "deleted.", "\n";
   if($problem>0)
   {
      echo "$problem file".($problem>1?"s":""), " ", "skipped.", "\n";
   }
   return 0;
}

main(intVal($argc),$argv);

?>
