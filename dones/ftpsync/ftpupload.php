<?php
include_once("ftp.php");
echo $argc, " ", $argv, "\n";

if(($argc<2)||($argc>6))
{
   die("Syntax solp ftpupload [server fname remotedir login password]");
}

$server="";
$fname="";
$user="";
$pass="";
$remotedir="";
if($argc>1)
{
   $server=$argv[1];
   if($argc>2)
   {
      $fname=$argv[2];
      if($argc>3)
      {
         $remotedir=$argv[3];
         if($argc>4)
         {
            $user=$argv[4];
            if($argc>5)
            {
               $pass=$argv[5];
            }
         }
      }
   }
}

if($server ==false)
{
      echo "Enter server (ex. ftp.domain.tld";
   $fp=fopen("php://stdin","r");
   $server=rtrim(fgets($fp,65536));
   fclose($fp);
}
if($server ==false)
{
   exit(0);
}

if($fname ==false)
{
      echo "Enter file";
   $fp=fopen("php://stdin","r");
   $fname=rtrim(fgets($fp,65536));
   fclose($fp);
}
if($fname ==false)
{
   exit(0);
}

if($fname ==false)
{
      echo "Enter remore directory (default www/)";
   $fp=fopen("php://stdin","r");
   $remotedir=rtrim(fgets($fp,65536));
   fclose($fp);
}
if($remotedir ==false)
{
   $remotedir="www/";
}

if($user ==false)
{
      echo "Enter login";
   $fp=fopen("php://stdin","r");
   $user=rtrim(fgets($fp,65536));
   fclose($fp);
}
if($user ==false)
{
   exit(0);
}

if($pass ==false)
{
      echo "Password";
   $fp=fopen("php://stdin","r");
   $pass=rtrim(fgets($fp,65536));
   fclose($fp);
}
if($pass ==false)
{
   exit(0);
}

echo "Connecting to $server", "\n";
$cnx=ftp_connect($server);
echo "Login $user", "\n";
$res=ftp_login($cnx,$user,$pass);
if($res===false)
{
   die("Error, $user unknown or bad password");
}

if(ftp_chdir($cnx,$remotedir)===true)
{
   echo "Now in", " ", ftp_pwd($cnx), " ", "dir", "\n";
}
else
{
   echo "Dir unchanged", "\n";
}

echo "Sending $fname", "\n";
if(ftp_put($cnx,basename($fname),$fname,FTP_ASCII)===true)
{
   echo "$fname uploaded", "\n";
}
else
{
   echo "Can't upload $fname", "\n";
}

ftp_close($cnx);

?>
