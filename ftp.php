<?php
// This is Ali's FTP Interface, PHP sessions edition
// Script created by Savas Ali Tokmen - http://ali.tokmen.com
// Date: 15 Nov 2007, version 2007.11.15.01

// STARTUP PARAMETERS
// You can call Ali's FTP Interface with the following paramaters
//     [filename].php?host=HOST&user=USER&pass=PASS&port=PORT&folder=FOLDER&passive=PASSIVE&mode=MODE&lang=LANG
//
// WHERE:
// HOST is the host name
// USER is the user name
// PASS is the password
// PORT is the port number
// FOLDER is the folder name
// LANG is the language code
// MODE is the viewind mode (detailed / bigIcons)
// PASSIVE is whether to use passive mode FTP (0 for "no" and 1 for "yes")
//
// Of course, all those items are optional. The first option should be called
// preceeded by a "?" sign and the others by a "&" sign.
// This way, you can launch without much pain the FTP Interface with the parameters
// you want. The user would then only have to press "connect" :)
//
// You can even directly launch a connection by adding a &sessID=connect after
// all your parameters.

// USER-SIDE VARIABLES USED BY THE FTP INTERFACE
//
// $sessID is SESSION ID
// $usePassive is whether to use PASSIVE FTP
// $hostname is HOSTNAME
// $username is USERNAME
// $password is PASSWORD
// $port is PORT
// $curFold is CURRENT FOLDER
// $action is the action to do
// $param1 gives the first parameter for that action
// $param2 gives the second parameter for that action
// $_FILES["uplfile"] is uploaded file content

// PHP should only report *big* problems
error_reporting(E_ERROR);

// Read a php.ini-style value in megabytes
function return_mbytes($val) {
	$val = trim($val);
	$last = strtolower($val{strlen($val)-1});
	$val = intval($val);
	switch($last) {
		case 'g':
			$val *= 1024;
		case 'm':
			break;
		case 'k':
			$val /= 1024;
	}

	return $val;
}

// Finds out the maximal POST upload size, in MB
function getMaxULSize() {
	$post = return_mbytes(ini_get('post_max_size'));
	$memory = return_mbytes(ini_get('memory_limit'));

	if($memory < 1) {
		return $post;
	}

	return $memory;
}

// Maximum size of downloads and uploads, in MB
//
// If you change ulLimit yourself make sure it's lower than getMaxULSize()
define("ulLimit",getMaxULSize());
define("dlLimit",5);

// You can use the config file to disable active (non-passive) FTP
// just by creating a config file with define("DontUseActiveFTP",DontUseActiveFTP);
define("where_to_find_config","config2.php");

// Define here the location of the ZIP2FTP interface
// This is used when the user wants to upload multiple files
define("zip2ftp","http://zip2ftp.alishomepage.com/");

// Import external variables
import_request_variables("gp");

// Language codes that can be used with their names
$langs=array("en","fr","tr");
$langExps=array("View this page in english","Voir cette page en français","Bu sayfayý türkçe olarak göster");

// HTML cleaner & inverse
function filterHTML($what){
	return str_replace(array("&","<",">","\""),array("&amp;","&lt;","&gt;","&quot;"),$what);
}
function unfilterHTML($what){
	return str_replace(array("&lt;","&gt;","&quot;","&amp;"),array("<",">","\"","&"),$what);
}

// PHP < 4.1.0 didn't have $_* but $HTTP_*_VARS
if(version_compare(phpversion(),"4.1.0")==-1){
	$_SERVER = $HTTP_SERVER_VARS;
	$_SESSION = $HTTP_SESSION_VARS;
	$_FILES = $HTTP_POST_FILES;
}

// PHP < 5 didn't have ftp_chmod
if(!is_callable('ftp_chmod',false)) {
	function shellfix($s) {
		return "'". str_replace("'", "'\''", $s)."'";
	}

	function ftp_chmod($ftp_stream, $mode, $filename) {
		return ftp_site($ftp_stream, sprintf('CHMOD %o %s', $mode, shellfix($filename)));
	}
}

// PHP < 5 didn't have stripos
if(!is_callable('stripos',false)) {
	function stripos($haystack, $needle){
		return strpos($haystack, stristr( $haystack, $needle ));
	}
}

// Script name
$scriptName=basename($_SERVER["SCRIPT_NAME"]);
define("scriptName",filterHTML($scriptName));

// Download source
if($do=="getSource"){
	// Download method depends on the browser
	$user_agent=strtolower($_SERVER["HTTP_USER_AGENT"]);
	header("Content-type: application/force-download");
	if((is_integer(strpos($user_agent,"msie")))&&(is_integer(strpos($user_agent,"win")))){
		header("Content-Disposition: filename=\"ftp_session.php\"");
	}else{
		header("Content-Disposition: attachment; filename=\"ftp_session.php\"");
	}
	header("Content-Description: File Transfert");

	// Send file
	readfile($scriptName);

/*
	// Send e-mail if needed (for usage statistics)
	if(strpos($user_agent,"bot")===false && strpos($_SERVER["SERVER_NAME"],"alishomepage.com")===false){
		mail("opensource@alishomepage.com","FTP Interface (PHP sessions edition): another one downloaded :)","This part will be referred to when the browser sends out no referrer information\n\nServer name: ".$_SERVER["SERVER_NAME"]."\nScript name: ".$_SERVER["SCRIPT_NAME"]."\nTranslated path: ".$_SERVER["PATH_TRANSLATED"]."\n\nDownloader's info (the referrer is most useful, user agent is to detect bots)\n\nUser agent: ".$_SERVER["HTTP_USER_AGENT"]."\nReferrer: ".$_SERVER["HTTP_REFERER"]."\nRequest URL: ".$_SERVER["REQUEST_URI"],"From: \"Ali's Open Source Initiative\" <opensource@alishomepage.com>");
	}
	die();
	*/
}


// Multilingual content
$content["en"]["title"]="Ali's FTP Interface";
$content["fr"]["title"]="Interface FTP d'Ali";
$content["tr"]["title"]="Ali'nin FTP Arayüzü";
$content["en"]["welcome"]="Welcome to Ali's FTP Interface";
$content["fr"]["welcome"]="Bienvenue à l'Interface FTP d'Ali";
$content["tr"]["welcome"]="Ali'nin FTP Arayüzü'ne hoþ geldiniz";
$content["en"]["resolution"]="This interface has been optimized for a minimal resolution of 1024*768 pixels";
$content["fr"]["resolution"]="Cette interface a été optimisée pour une résolution minimale de 1024*768 pixels";
$content["tr"]["resolution"]="Bu arayüz en düþük 1024*768'lik bir çözünürlük için eniyileþtirilmiþtir";
$content["en"]["getSource"]="This is a multilingual, completely free and Open Source (or OpenSource) software / script. Please <a href=\"".scriptName."?do=getSource\">click here</a> to get its source code [written in PHP]";
$content["fr"]["getSource"]="Ceci est un programme / logiciel / script qui est multi-langues, complètement gratuit et à sources ouvertes (Open Source). Vous pouvez <a href=\"".scriptName."?do=getSource\">cliquez ici</a> pour télécharger le code source, écrit en PHP";
$content["tr"]["getSource"]="Bu yazýlým / program / script çok dilli, tamamen bedava ve açýk kaynaklýdýr (Open Source). PHP'de yazýlmýþ kaynak kodunu indirmek için lütfen <a href=\"".scriptName."?do=getSource\">buraya týklayýn</a>";
$content["en"]["copy"]="Ali's HTTP to FTP interface (PHP sessions edition) created by Savas Ali Tokmen";
$content["fr"]["copy"]="L'interface HTTP vers FTP d'Ali (édition sessions PHP) crée par Savas Ali Tokmen";
$content["tr"]["copy"]="Ali'nin HTTP üzerinden FTP arayüzü (PHP session sürümü) Savaþ Ali Tokmen tarafýndan yaratýlmýþtýr";
$content["en"]["form"]=array(
	"Please enter the server connection details to initiate connection with the FTP server",
	"Hostname",
	"Username",
	"Password",
	"Port (standard is 21)",
	"Folder to list (optional)",
	"Use passive mode FTP",
	"No",
	"Yes",
	"Go",
	""
	);
$content["fr"]["form"]=array(
	"Veuillez rentrer les détails du serveur pour initier la connexion FTP",
	"Adresse du serveur",
	"Nom d'utilisateur",
	"Mot de passe",
	"Port (la standard est 21)",
	"Classeur à lister (optionnel)",
	"Utiliser le mode FTP passif",
	"Non",
	"Oui",
	"Allons-y",
	""
	);
$content["tr"]["form"]=array(
	"Baðlantýyý kurmak için lütfen sunucu ile ilgili detaylarý girin",
	"Sunucu adresi",
	"Kullanýcý adý",
	"Parola",
	"Port (standart deðer 21dir)",
	"Listelenecek klasör (opsiyonel)",
	"Baðlantý pasif modda yapýlsýn mý",
	"Hayýr",
	"Evet",
	"Baðlan",
	""
	);
$content["en"]["errorlist"]=array(
	array("Download failed", "cannot fetch file from FTP server (connection error?)", "cannot create temporary file", "Check that PHP can access"),
	"Change folder failed",
	"Change permissions failed",
	"That permission list is not valid\\n\\nPlease use UNIX format (like drwxrwxrwx)",
	"Rename failed",
	"Delete folder failed",
	"Delete file failed",
	"Create folder failed",
	"Upload failed",
	"Connection to the FTP server has failed",
	"Security error: Your identifier information doesn't match with your session's",
	"ERROR: No such session");
$content["fr"]["errorlist"]=array(
	array("Le téléchargement a échoué", "impossible de télécharger le fichier depuis le serveur FTP (erreur de connection?)", "impossible de créer un fichier temporaire", "Vérifier que PHP peut accéder à"),
	"Le changement de classeur a échoué",
	"Le changement de permissions a échoué",
	"Cette permission n\\'est pas valide\\n\\nMerci d\\'utiliser le format UNIX (genre drwxrwxrwx)",
	"Le renommage a échoué",
	"L\\'effacement du classeur a échoué",
	"L\\'effacement du fichier a échoué",
	"La création du classeur a échoué",
	"L\\'upload a échoué",
	"La connexion a serveur FTP a échoué",
	"Erreur de sécurité: votre identifiant ne correspond pas à ceux de votre session",
	"ERREUR: Session invalide");
$content["tr"]["errorlist"]=array(
	array("Ýndirme baþarýsýz", "FTP sunucudan dosya indirilemiyor (baðlantý hatasý?)", "geçici dosya yaratýlamýyor", "PHP'nin þuraya eriþebildiðinden emin olun"),
	"Klasör deðiþimi baþarýsýz",
	"Haklarý deðiþtirme baþarýsýz",
	"Bu hak listesi geçerli deðil\\n\\nLütfen UNIX formatý kullanýn (drwxrwxrwx gibi)",
	"Yeniden isimlendirme baþarýsýz",
	"Klasör silme baþarýsýz",
	"Dosya silme baþarýsýz",
	"Klasör yaratma baþarýsýz",
	"Dosya yollama baþarýsýz",
	"FTP sunucusuna baðlantý baþarýsýz",
	"Güvenlik hatasý: Sizinle ilgili bilgiler session bilgilerinizle uyumsuz",
	"HATA: Session bulunamadý");
$content["en"]["msgs"]=array(
	"You've been logged out successfully",
	"Logout has failed",
	"Connected to",
	"as",
	"(<a href=\"javascript:action('disconnect')\"><b>click here</b></a> to disconnect)",
	"Current folder is",
	"(<a href=\"javascript:var tmp=window.prompt('Enter folder name','New Folder');if(tmp!=null){action('mkdir',tmp)}\"><b>click here</b></a> to create a new folder)",
	"Send file: (limited to at most ".ulLimit." MB)",
	"Send",
	"Note that your FTP password will not be transmitted to the ZIP2FTP interface, you will therefore have to re-enter it",
	"Click here to upload multiple files",
	"Explanations will appear here",
	"<b>Click here</b></a> to go to the parent directory",
	"<b>Click here</b></a> to go to the root directory",
	"<b>Click here</b></a> to refresh",
	"The content will be dynamically generated using JavaScript code and refreshed as things get resized",
	"About the file <b>\"+files[number][0]+\"</b>",
	"File size",
	"Modified",
	"Owner",
	"Permissions",
	"Click to go to the parent directory",
	"About the folder <b>\"+folders[number][0]+\"</b>",
	"<b>WARNING</b>: this folder is empty or all its elements are hidden and / or virtual<br><br>You may want to go to the parent or root directory to see some content...",
	"Point on an item to view its description",
	"( parent folder )",
	"Enter new name",
	"( rename )",
	"Enter new permissions",
	"( permissions )",
	"Are you sure you want to delete folder and all its contents",
	"( delete )",
	"Are you sure you want to delete file",
	"File / folder name");
$content["fr"]["msgs"]=array(
	"Vous avez été déconnecté(e) avez succès",
	"La déconnection a échouée",
	"Connecté à",
	"en tant que",
	"(<a href=\"javascript:action('disconnect')\"><b>cliquez ici</b></a> pour déconnecter)",
	"Le classeur courant est",
	"(<a href=\"javascript:var tmp=window.prompt('Entrez le nom de classeur','Nouveau Classeur');if(tmp!=null){action('mkdir',tmp)}\"><b>cliquez ici</b></a> pour créer un nouveau classeur)",
	"Envoyer un fichier: (limité à au maximum ".ulLimit." MB)",
	"Envoyer",
	"Notez que votre mot de passe ne sera pas transmis à l\\'interface ZIP2FTP, vous aurez donc à le re-rentrer",
	"Cliquez ici pour envoyer plusieurs fichiers",
	"Les explications apparaitront ici",
	"<b>Cliquez ici</b></a> pour aller au classeur parent",
	"<b>Cliquez ici</b></a> pour aller à la racine",
	"<b>Cliquez ici</b></a> pour rafraichir",
	"The contenu va être dynamiquement généré en utilisant JavaScript et mis à jour quand les choses sont redimensionnées",
	"Au sujet de <b>\"+files[number][0]+\"</b>",
	"Taille",
	"Modifié",
	"Propriétaire",
	"Permissions",
	"Cliquez pour aller au classeur parent",
	"Au sujet de <b>\"+folders[number][0]+\"</b>",
	"<b>ATTENTION</b>: ce classeur est vide ou tous ces éléments sont cachés / virtuels.<br><br>Veuillez aller au parent ou à la racine pour avoir plus de contenu...",
	"Pointez un élément pour sa description",
	"( classeur parent )",
	"Entrer un nouveau nom",
	"( renommer )",
	"Entrer de nouvelles permissions",
	"( permissions )",
	"Etes-vous sûr de vouloir effacer ce classeur et tout son contenu",
	"( effacer )",
	"Etes-vous sûr de vouloir effacer ce fichier",
	"Nom du fichier / classeur");
$content["tr"]["msgs"]=array(
	"Çýkýþ baþarýyla tamamlandý",
	"Çýkýþ baþarýsýz",
	"Sunucu:",
	", kullanýcý:",
	"(baðlantýyý kesmek için <a href=\"javascript:action('disconnect')\"><b>buraya týklayýn</b></a>)",
	"Þu anki klasör",
	"(<a href=\"javascript:var tmp=window.prompt('Yeni klasör adý girin','Yeni Klasor');if(tmp!=null){action('mkdir',tmp)}\"><b>Yeni bir klasör yarat</b></a>)",
	"Dosya yolla: (en fazla ".ulLimit." MB)",
	"Yolla",
	"Unutmayýn ki FTP parolanýz ZIP2FTP arayüzüne ulaþtýrýlmayacaktýr, dolayýsýyla tekrar girmeniz gerekmektedir",
	"Bir çok dosya yollamak için týklayýn",
	"Açýklamalar buraya gelecek",
	"<b>Buraya týklayarak</b></a> bir üst klasöre gidebilirsiniz",
	"<b>Buraya týklayarak</b></a> ana klasöre gidebilirsiniz",
	"<b>Buraya týklayarak</b></a> sayfayý güncelleyebilirsiniz",
	"Ýçerik JavaScript tarafýndan dinamik olarak yaratýlacak ve cisimler þekil deðiþtirdikçe otomatik olarak yeniden boyutlandýrýlacaktýr",
	"<b>\"+files[number][0]+\"</b> hakkýnda",
	"Boyut",
	"Deðiþtirilme",
	"Sahip",
	"Haklar",
	"Bir üst klasöre gitmek için týklayýn",
	"<b>\"+folders[number][0]+\"</b> hakkýnda",
	"<b>UYARI</b>: bu klasör boþ veya tüm elemanlarý gizli / sanal<br><br>Daha fazla içerik için bir üst veya ana klasöre gitmeniz tavsiye olunur...",
	"Açýklamasýný görmek için bir cismin üzerine gidin",
	"( bir üst klasör )",
	"Yeni isim girin",
	"( yeniden adlandýr )",
	"Yeni haklar girin",
	"( haklar )",
	"Bu klasörü ve tüm içeriðini silmek istediðinize emin misiniz",
	"( sil )",
	"Bu dosyayý silmek istediðinize emin misiniz",
	"Dosya / klasör adý");
$content["en"]["views"]=array(
	"Viewing style",
	"Big icons",
	"Detailed",
	"<b>Click here</b></a> to switch to the detailed view",
	"<b>Click here</b></a> to switch to the big icons view");
$content["fr"]["views"]=array(
	"Style de vue",
	"Grandes icones",
	"Détaillé",
	"<b>Cliquez ici</b></a> pour passer en vue détaillée",
	"<b>Cliquez ici</b></a> pour passer en vue grandes icônes");
$content["tr"]["views"]=array(
	"Görünüm stili",
	"Büyük ikonlar",
	"Detaylý",
	"<b>Buraya týklayarak</b></a> detaylý görünüm stiline geçebilirsiniz",
	"<b>Buraya týklayarak</b></a> büyük ikonlu görünüm stiline geçebilirsiniz");

// Include the config if required
if(file_exists(where_to_find_config)){
	include(where_to_find_config);
}

// HTTP needs to know about ulLimit in bytes
define("ulLimit_bytes",ulLimit*1024*1024);

// Clean variables
$port=intval($port);
if($param1){$param1=stripslashes($param1);}
if($param2){$param2=stripslashes($param2);}
if(!$port || $port<1 || $port>65535){$port=21;}
if($sessID){$sessID=addslashes(stripslashes($sessID));}
if($curFold){$curFold=str_replace(array("\\\"","\'","\\\\"),array("\"","'","\\"),$curFold);}

// Choose default language if needed
if(!in_array($lang,$langs)){$lang=$langs[0];}

// Lowercase letters & replace certain characters, for sorting
function arraytolowercase_standard($array){
	$return=array();
	for($i=0;$i<sizeof($array);$i++){
		$return[$i]=strtolower(strtr($array[$i],"ÉÈÊÀÁÂÇÐÝÖÞÜéèêàáâçðýöþü","eeeaaacgiosueeeaaacgiosu"));
	}
	return $return;
}

// The "simple start" output
function simple_start($td_size){
	global $content,$lang;
?>
<meta http-equiv='Content-Type' content='text/html;charset=windows-1254'>
<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-9'>
<title><? echo $content[$lang]["title"]; ?></title>
<style>
BODY{
	background:#FEFEFE;
	font-family:tahoma,arial,helvetica;
	color:#000000;
	cursor:default;
	-moz-user-select:none
}

input{
	font-family:tahoma,arial,helvetica;
	font-size:13;
	color:#000000;
	-moz-user-select:normal
}

select{
	font-family:tahoma,arial,helvetica;
	font-size:13;
	color:#000000;
	-moz-user-select:normal
}

TD{
	font-size:<? echo intval($td_size); ?>
}

H1{
	font-size:20
}

A{
	text-decoration:none;
	color:#2B5796
}

A:hover{
	color:#FF6262;
	text-decoration:underline
}
</style>
<?
}

// The "start of the main form" output
function form_start(){
	global $content,$lang;
	simple_start(13);
?>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<div align=center>
<table height=100% width=550 cellpadding=0 cellspacing=0>
<tr valign=middle><td align=center>
<h1><? echo $content[$lang]["welcome"]; ?></h1><br>
<?
}

// The "simple end" output
function simple_end(){
	global $content,$langs,$langExps,$lang,$mode;
	echo "<br><br><br>";
	$howto1=scriptName."?lang=";
	$howto2="&mode=$mode";

	echo "<font size=2>";
	$separ="";
	for($i=0;$i<sizeof($langs);$i++){
		if($langs[$i]!=$lang){
			echo "$separ<b><a href=\"".$howto1.$langs[$i].$howto2."\">".$langExps[$i]."</a></b>";
			$separ=" | ";
		}
	}
?>
<br><br><br></font><font size=1>
<? echo $content[$lang]["resolution"]; ?>
<font size=2><br><br></font><font size=1>
<? echo $content[$lang]["getSource"]; ?>.
<font size=2><br><br></font><font size=1><? echo $content[$lang]["copy"]; ?><br><br>
<a href=http://myftp.alishomepage.com target=_blank>http://myftp.alishomepage.com</a><br>
<a href=http://subs.alishomepage.com target=_blank>http://subs.alishomepage.com</a><br><br>
<a href=http://contact.ali.tokmen.com target=_blank>http://contact.ali.tokmen.com</a><br>
<a href=http://ali.tokmen.com target=_blank>http://ali.tokmen.com</a>
</td></tr></table>
<script>
function onSelectStart() {
	if( window.event.srcElement.tagName != "INPUT" ) {
		window.event.returnValue = false
		window.event.cancelBubble = true
	}
}

document.onselectstart=onSelectStart
</script>
<?
}

// The "login form" output
function login_form( $str ){
	global $content,$lang,$host,$user,$pass,$port,$folder,$passive,$mode;
	form_start();
?>
<? if($str){ echo "<table style='border-right: #cccccc 1px dotted; border-top: #cccccc 1px dotted; border-left: #cccccc 1px dotted; color: #0000ff; padding-top: 2px; border-bottom: #cccccc 1px dotted; background-color: #fefefe' callpadding=8 cellspacing=8><tr valign=middle><td align=center><img src=img/info.gif></td><td align=center>$str</td></tr></table><br><br>"; } ?>
<? echo $content[$lang]["form"][0]; ?><br><br><br>
<form action="<? echo scriptName; ?>?lang=<? echo $lang; ?>" method=POST>
<input type=hidden name=sessID value=connect>
<table style='border-right: #cccccc 1px dotted; border-top: #cccccc 1px dotted; border-left: #cccccc 1px dotted; color: #110044; padding-top: 2px; border-bottom: #cccccc 1px dotted; background-color: #fafafa' border=0 cellpadding=3 cellspacing=7>
<tr><td align=right width=47%><? echo $content[$lang]["form"][1]; ?> : </td>
<td><input size=20 name=host type=text maxlength=128 value="<? echo htmlspecialchars(str_replace(array("\\\"","\\'","\\\\"),array("\"","'","\\"),$host)); ?>"></td></tr>
<tr><td align=right><? echo $content[$lang]["form"][2]; ?> : </td><td><input size=20 name=user type=text maxlength=128 value="<? echo htmlspecialchars(str_replace(array("\\\"","\\'","\\\\"),array("\"","'","\\"),$user)); ?>"></td></tr>
<tr><td align=right><? echo $content[$lang]["form"][3]; ?> : </td><td><input size=20 name=pass type=password maxlength=128 value="<? echo htmlspecialchars(str_replace(array("\\\"","\\'","\\\\"),array("\"","'","\\"),$pass)); ?>"></td></tr>
<tr><td align=right><? echo $content[$lang]["form"][4]; ?> : </td><td><input size=20 name=port type=text maxlength=5 value=<? echo $port; ?>></td></tr>
<tr><td align=right><? echo $content[$lang]["form"][5]; ?> : </td><td><input size=20 name=curFold type=text maxlength=128 value="<? echo htmlspecialchars(str_replace(array("\\\"","\\'","\\\\"),array("\"","'","\\"),$folder)); ?>"></td></tr>
<tr><td align=right><? echo $content[$lang]["form"][6]; ?> ? </td><td><select name=usePassive><option <? if(!defined("DontUseActiveFTP") && !intval($passive)){echo "selected ";} ?>value=0><? echo $content[$lang]["form"][7]; ?><option <? if(defined("DontUseActiveFTP") || intval($passive)){echo "selected ";} ?>value=1><? echo $content[$lang]["form"][8]; ?></select></td></tr>
<tr><td align=right><? echo $content[$lang]["views"][0]; ?> : </td><td><select name=mode><option <? if($mode!="detailed"){echo "selected ";} ?>value=bigIcons><? echo $content[$lang]["views"][1]; ?><option <? if($mode=="detailed"){echo "selected ";} ?>value=detailed><? echo $content[$lang]["views"][2]; ?></select></td></tr></table><br>
<input type=submit value="<? echo $content[$lang]["form"][9]; ?> !"></form>
<? echo $content[$lang]["form"][10]; ?>
<?
	simple_end();
}

// PHP versions < 4.2.0 didn't have "timeout" in the ftp_connect method
if(version_compare(phpversion(),"4.2.0")==-1){
	function start_ftp_connection($host,$port){
		return ftp_connect($host,$port);
	}
}else{
	function start_ftp_connection($host,$port){
		return ftp_connect($host,$port,30);
	}
}

// File download, same notes as for GetSource
if($action=="down" && strlen($param1)>0){
	session_name("sessID");
	session_id($sessID);
	session_start();
	$sessInfo=array(
		"ip"		=>	$_SESSION["ip"],
		"hostname"	=>	$_SESSION["hostname"],
		"username"	=>	$_SESSION["username"],
		"password"	=>	$_SESSION["password"],
		"port"		=>	$_SESSION["port"],
		"passive"	=>	$_SESSION["passive"]);
	session_write_close();

	// Verify that it is the good person
	if($sessInfo["ip"]==$_SERVER["REMOTE_ADDR"]){
		$tempName=tempnam("", "ftp_session");
		$hostname=$sessInfo["hostname"];
		$username=$sessInfo["username"];
		$password=$sessInfo["password"];
		$port=$sessInfo["port"];
		$usePassive=$sessInfo["passive"];
		if($usePassive==1 || defined("DontUseActiveFTP")){$usePassive=true;}else{$usePassive=false;}
		$conn_id=start_ftp_connection($hostname,$port);
		if($conn_id && ftp_login($conn_id,$username,$password) && ftp_chdir($conn_id,$curFold) && ftp_size($conn_id,$param1)<dlLimit*1048576 && ftp_pasv($conn_id,$usePassive) && ftp_get($conn_id,$tempName,$param1,FTP_BINARY) && ftp_quit($conn_id)){
			$user_agent=strtolower($_SERVER["HTTP_USER_AGENT"]);
			header("Content-type: application/force-download");
			if((is_integer(strpos($user_agent,"msie")))&&(is_integer(strpos($user_agent,"win")))){
				header("Content-Disposition: filename=\"$param1\"");
			}else{
				header("Content-Disposition: attachment; filename=\"$param1\"");
			}
			header("Content-Description: File Transfert");
			readfile($tempName);
			unlink($tempName);
			die();
		}
	}
	unlink($tempName);
	echo "<script>alert(\"".$content[$lang]["errorlist"][0][0].": ";
	if($tempName != ""){
		echo $content[$lang]["errorlist"][0][1];
	}else{
		echo $content[$lang]["errorlist"][0][2];
		$tempName = sys_get_temp_dir();
	}
	echo "\\n\\n".$content[$lang]["errorlist"][0][3].": ".str_replace(array("\\","\"","\n","\r"), array("\\\\","\\\"","",""), $tempName)."\");window.opener=self;window.close()</script>";
	die();
}

// Function to transform "        a" into "a"
function cutLeadingSpaces($str){
	while(substr($str,0,1)==" "){$str=substr($str,1);}
	return $str;
}

// Recursive directory remover
function ftp_rec_rmdir($conn_id,$folder){
	ftp_chdir($conn_id,$folder);
	$folders=array();
	$files=array();
	$list=ftp_rawlist($conn_id,"");
	for($i=0;$i<sizeof($list);$i++){
		list($permissions,$next)=split(" ",$list[$i],2);
		list($num,$next)=split(" ",cutLeadingSpaces($next),2);
		list($owner,$next)=split(" ",cutLeadingSpaces($next),2);
		list($group,$next)=split(" ",cutLeadingSpaces($next),2);
		list($size,$next)=split(" ",cutLeadingSpaces($next),2);
		list($month,$next)=split(" ",cutLeadingSpaces($next),2);
		list($day,$next)=split(" ",cutLeadingSpaces($next),2);
		list($year_time,$filename)=split(" ",cutLeadingSpaces($next),2);
		if(strlen($filename)>0 && $filename!="." && $filename!=".."){
			if(substr($permissions,0,1)=="d"){
				$folders[]=$filename;
			} else {
				$files[]=$filename;
			}
		}
	}
	for($i=0;$i<sizeof($folders);$i++){
		ftp_rec_rmdir($conn_id,$folders[$i]);
	}
	for($i=0;$i<sizeof($files);$i++){
		ftp_delete($conn_id,$files[$i]);
	}
	ftp_cdup($conn_id);
	return ftp_rmdir($conn_id,$folder);
}

// Compressed output (faster transmission)
ob_implicit_flush(0);
ob_start();
define('ZIP_IT', extension_loaded('zlib') && strstr($_SERVER["HTTP_ACCEPT_ENCODING"],'gzip'));

if(($sessID && $sessID!="connect") || ($sessID=="connect" && $host && $user)){
	// There's a session ID, so user is / will be logged in
	if($action=="disconnect"){
		// Disconnection = destroy session
		session_name("sessID");
		session_id($sessID);
		session_start();
		session_unset();
		session_write_close();
		session_start();
		session_destroy();
		
		if(setcookie(session_name(),"",0,"/")){
			login_form($content[$lang]["msgs"][0]);
		}else{
			login_form($content[$lang]["msgs"][1]);
		}
	}else{
		// Not disconnecting...
		if($sessID=="connect"){
			// Connecting: create new ID and store it
//			session_name("sessID");
//			session_start();
//			session_regenerate_id();
			session_start();
			$sessID=session_id();
			function antiXSS($what){
				return str_replace(array("&slash;","&amp;"),array("\\","&"),stripslashes(str_replace(array("&","\\\\"),array("&amp;","&slash;"),$what)));
			}
			$_SESSION["ip"]=$_SERVER["REMOTE_ADDR"];
			$_SESSION["hostname"]=antiXSS($host);
			$_SESSION["username"]=antiXSS($user);
			$_SESSION["password"]=antiXSS($pass);
			$_SESSION["port"]=$port;
			$_SESSION["passive"]=intval($usePassive);
			session_write_close();
		}
		session_name("sessID");
//		session_id($sessID);
		session_start();
		$sessInfo=array(
			"ip"		=>	$_SESSION["ip"],
			"hostname"	=>	$_SESSION["hostname"],
			"username"	=>	$_SESSION["username"],
			"password"	=>	$_SESSION["password"],
			"port"		=>	$_SESSION["port"],
			"passive"	=>	$_SESSION["passive"]);
		session_write_close();

		// Check that it is the supposed user
		if($sessInfo["ip"]==$_SERVER["REMOTE_ADDR"]){
			$hostname=$sessInfo["hostname"];
			$username=$sessInfo["username"];
			$password=$sessInfo["password"];
			$port=$sessInfo["port"];
			$usePassive=$sessInfo["passive"];
			if($usePassive==1){$usePassive=true;}else{$usePassive=false;}
			$conn_id=start_ftp_connection($hostname,$port);

			// At this point, connection should be extablished
			if($conn_id && ftp_login($conn_id,$username,$password)){
				// Change folder, rename, delete, create folder, upload, ...
				if($curFold){
					if(!ftp_chdir($conn_id,$curFold)){
						echo "<script>alert('".$content[$lang]["errorlist"][1]."')</script>";
					}
				}

				$curFold=filterHTML(str_replace("\"\"", "\"", ftp_pwd($conn_id)));

				if($action=="go"){
					if($param1==".."){
						$result=ftp_cdup($conn_id);
					}else{
						$result=ftp_chdir($conn_id,$param1);
					}
					if($result){
						$curFold=filterHTML(str_replace("\"\"", "\"", ftp_pwd($conn_id)));
					}
				}

				if($action=="perm"){
					if(strlen($param2)==10){
						$possPerms="rwx";
						$cPerms=0;
						for($i=3;$i>0;$i--){
							$current=substr($param2,strlen($param2)-3);
							for($j=0;$j<3;$j++){
								if(false!==stripos($current,$possPerms[$j])){
									$cPerms+=pow(2,$j)*pow(10,abs($i-3));
								}
							}
							$param2=substr($param2,0,strlen($param2)-3);
						}
						if(!ftp_chmod($conn_id,$cPerms,$param1)) {
							echo "<script>alert('".$content[$lang]["errorlist"][2]."')</script>";
						}
					}else{
						echo "<script>alert('".$content[$lang]["errorlist"][3]."')</script>";
					}
				}

				if($action=="rn"){
					if(!ftp_rename($conn_id,$param1,$param2)){
						echo "<script>alert('".$content[$lang]["errorlist"][4]."')</script>";
					}
				}

				if($action=="rmdir"){
					if(!ftp_rec_rmdir($conn_id,$param1)){
						echo "<script>alert('".$content[$lang]["errorlist"][5]."')</script>";
					}
				}

				if($action=="rm"){
					if(!ftp_delete($conn_id,$param1)){
						echo "<script>alert('".$content[$lang]["errorlist"][6]."')</script>";
					}
				}

				if($action=="mkdir"){
					if(!ftp_mkdir($conn_id,$param1)){
						echo "<script>alert('".$content[$lang]["errorlist"][7]."')</script>";
					}
				}

				ftp_pasv($conn_id,$usePassive);

				if($action=="put"){
					if(!($_FILES["uplFile"] && $_FILES["uplFile"]["size"]<=ulLimit_bytes && ftp_put($conn_id,$_FILES["uplFile"]["name"],$_FILES["uplFile"]["tmp_name"],FTP_BINARY))){
						echo "<script>alert('".$content[$lang]["errorlist"][8]."')</script>";
					}
				}

				$list=ftp_rawlist($conn_id,"");
				ftp_quit($conn_id);

				// Finished doing requested operations and getting file list, now create output
				$list=str_replace("&","&amp;",$list);
				$foldPerm=array();
				$filePerm=array();
				$folders=array();
				$files=array();
				$fileSizes=array();
				$fileOwner=array();
				$foldOwner=array();
				$fileLastMod=array();
				$foldLastMod=array();
				for($i=0;$i<sizeof($list);$i++){
					list($permissions,$next)=split(" ",$list[$i],2);
					list($num,$next)=split(" ",cutLeadingSpaces($next),2);
					list($owner,$next)=split(" ",cutLeadingSpaces($next),2);
					list($group,$next)=split(" ",cutLeadingSpaces($next),2);
					list($size,$next)=split(" ",cutLeadingSpaces($next),2);
					list($month,$next)=split(" ",cutLeadingSpaces($next),2);
					list($day,$next)=split(" ",cutLeadingSpaces($next),2);
					list($year_time,$filename)=split(" ",cutLeadingSpaces($next),2);
					if(strlen($filename)>0 && $filename!="." && $filename!=".."){
						if(substr($permissions,0,1)=="d"){
							$foldPerm[]=$permissions;		// was "permisions" ... thank you, Tomas Kmieliauskas :)
							$folders[]=$filename;
							$foldOwner[]=$owner;
							$foldLastMod[]=$day." ".$month." ".$year_time;
						} else {
							$filePerm[]=$permissions;
							$files[]=$filename;
							$fileOwner[]=$owner;
							$fileLastMod[]=$day." ".$month." ".$year_time;
							$fileSizes[]=$size;
						}
					}
				}
				$arrangerFold=arraytolowercase_standard($folders);
				$arrangerFile=arraytolowercase_standard($files);
				array_multisort($arrangerFold,$folders,$foldOwner,$foldLastMod);
				array_multisort($arrangerFile,$files,$fileSizes,$fileOwner,$fileLastMod);

				// Finished arranging the content, now print it out
				if($curFold==""){
					$foldExplain="/";
				}else{
					$foldExplain=unfilterHTML($curFold);
					if(strlen($foldExplain)<22){
						$foldExplain=filterHTML($foldExplain);
					}else{
						$foldExplain=filterHTML(substr($foldExplain,0,7)." (...) ".substr($foldExplain,strlen($foldExplain)-13));
					}
				}

if($action=="setView"){
	if($param1=="detailed"){
		$mode="detailed";
	}else{
		$mode="bigIcons";
	}
}

if( $mode!="detailed" && $mode!="bigIcons" ){  $mode="bigIcons";  }

simple_start(11);

?>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 scroll=no>
<table height=100% width=100% cellpadding=0 cellspacing=0>
<tr valign=top><td width=250 align=left>
<div id=leftFrame style=overflow:hidden;width:250;padding-left:0px;padding-right:0px;padding-top:0px;padding-bottom:0px>
<img src=img/logo.gif><br>
<div style=padding-left:10px>
<font size=3><b><? echo $content[$lang]["title"]; ?></b></font>
</div>
<br>
<table width=250><tr bgcolor=#6699CC height=2><td></td></tr></table>
<br>
<div style=padding-left:10px>
<? echo $content[$lang]["msgs"][2]; ?> <b><? echo filterHTML($hostname); ?></b> <? echo $content[$lang]["msgs"][3]; ?> <b><? echo filterHTML($username); ?></b><br>
&nbsp; &nbsp; &nbsp; <? echo $content[$lang]["msgs"][4]; ?>
<br><br>
<? echo $content[$lang]["msgs"][5]; ?> <b><? echo $foldExplain; ?></b><br>
&nbsp; &nbsp; &nbsp; <? echo $content[$lang]["msgs"][6]; ?>
<br><br></div>
<center>
<form action="<? echo scriptName; ?>?lang=<? echo $lang; ?>&mode=<? echo ($mode=="detailed"?"detailed":"bigIcons"); ?>" method=POST enctype=multipart/form-data>
<? echo $content[$lang]["msgs"][7]; ?><br>
<input type=hidden name=MAX_FILE_SIZE value=<? echo ulLimit_bytes; ?>>
<input type=hidden name=sessID value=<? echo $sessID; ?>>
<input type=hidden name=curFold value="<? echo $curFold; ?>">
<input type=hidden name=action value="put">
<input type=file name=uplFile size=10 style=font-family:verdana,arial,helvetica;font-size:11;color:#000000> <input type=submit value=<? echo $content[$lang]["msgs"][8]; ?> style=font-family:verdana,arial,helvetica;font-size:11;color:#000000><br><br>
<!--b><a href="<? echo filterHTML(zip2ftp)."?host=".filterHTML($sessInfo["hostname"])."&user=".filterHTML($sessInfo["username"])."&port=".$sessInfo["port"]."&folder=".$curFold."&passive=".$sessInfo["passive"]; ?>" target=_blank onclick="alert('<? echo $content[$lang]["msgs"][9]; ?>')"><? echo $content[$lang]["msgs"][10]; ?></a></b-->
</form></center>
<div style=padding-left:10px>
<div id=description style="background:#FFFFE1;width:220;border-right:#D3D3D3 1px solid;border-left:#D3D3D3 1px solid;border-top:#D3D3D3 1px solid;border-bottom:#D3D3D3 1px solid;padding-left:7px;padding-right:7px;padding-top:7px;padding-bottom:7px"><? echo $content[$lang]["msgs"][11]; ?></div>
<br><br>
<a href="javascript:action('setView','<? echo ($mode=="detailed"?"bigIcons":"detailed"); ?>')"><? echo $content[$lang]["views"][$mode=="detailed"?4:3]; ?><br><br>
<a href="javascript:action('go','..')"><? echo $content[$lang]["msgs"][12]; ?><br><br>
<a href="javascript:action('go','/')"><? echo $content[$lang]["msgs"][13]; ?><br><br>
<a href="javascript:action()"><? echo $content[$lang]["msgs"][14]; ?>
<form action="<? echo scriptName; ?>?lang=<?echo $lang; ?>&mode=<? echo ($mode=="detailed"?"detailed":"bigIcons"); ?>" name=changeThings method=POST>
<input type=hidden name=sessID value=<? echo $sessID; ?>>
<input type=hidden name=curFold value="<? echo $curFold; ?>">
<input type=hidden name=action value="">
<input type=hidden name=param1 value="">
<input type=hidden name=param2 value="">
</form>
</div>
</div>
</td><td>
<div id=content style="overflow:auto;padding-left:0px;padding-right:0px;padding-top:0px;padding-bottom:0px">
<br><br><? echo $content[$lang]["msgs"][15]; ?>...
</div>
</td></tr></table>
<script>
function safePrint( str ){
<?
	if($mode=="bigIcons"){
?>
	if(str.length>18){
		str = str.substring(0,6)+" (...) "+str.substring(str.length-6,str.length)
	}
<?
	}else{
?>
	if(str.length>40){
		str = str.substring(0,17)+" (...) "+str.substring(str.length-17,str.length)
	}
<?
	}
?>
	return str
}

function escapeSlashes( str ){
	return str.replace(/\\/g, "\\\\").replace(/'/g, "\\'")
}

function action(action, param1, param2){
	document.changeThings.elements["action"].value=action
	document.changeThings.elements["param1"].value=param1
	document.changeThings.elements["param2"].value=param2
	if(action=="down"){
		document.changeThings.target="_blank"
	}else{
		document.changeThings.target="_self"
	}
	document.changeThings.submit()
}

function markMe(){
	var docWidth
	var docHeight
	if(navDOM){
		docWidth=document.body.clientWidth
		docHeight=document.body.clientHeight
	}else{
		docWidth=window.innerWidth
		docHeight=window.innerHeight
	}

	if(d_w!=docWidth){
		d_w=parseInt(docWidth)
		mainLayer.style.width=d_w-250
		mainLayer.style.height=parseInt(docHeight)
		leftLayer.style.height=parseInt(docHeight)
		refreshContents()
	}
}

function bul(neyi){
	if(document.getElementById&&document.getElementById(neyi)){return document.getElementById(neyi)}
	if(document.all&&document.all(neyi)){return document.all(neyi)}
	if(document.layers&&document.layers[neyi]){return document.layers[neyi]}
	return false
}

function explain(style,number){
	var output=""
	if(style=="file"){
		output+="<? echo $content[$lang]["msgs"][16]; ?>:<br>&nbsp;"
		output+="<table cellpadding=3 cellspacing=0>"
		output+="<tr valign=middle height=15 valign=top><td align=right width=60><? echo $content[$lang]["msgs"][17]; ?>:</td><td>"+files[number][2]+"</td></tr>"
		output+="<tr valign=middle height=15 valign=top><td align=right width=60><? echo $content[$lang]["msgs"][18]; ?>:</td><td>"+files[number][1]+"</td></tr>"
		if(files[number][3].length>0){
			output+="<tr valign=middle height=15 valign=top><td align=right width=60><? echo $content[$lang]["msgs"][19]; ?>:</td><td>"+files[number][3]+"</td></tr>"
		}
		output+="<tr valign=middle height=15 valign=top><td align=right width=60><? echo $content[$lang]["msgs"][20]; ?>:</td><td>"+files[number][4]+"</td></tr>"
		output+="</table>"
	}else if(style=="folder"){
		if(folders[number][0]==".."){
			output+="<? echo $content[$lang]["msgs"][21]; ?>"
		}else{
			output+="<? echo $content[$lang]["msgs"][22]; ?>:<br>&nbsp;"
			output+="<table cellpadding=3 cellspacing=0>"
			output+="<tr valign=middle height=15 valign=top><td align=right width=60><? echo $content[$lang]["msgs"][18]; ?>:</td><td>"+folders[number][1]+"</td></tr>"
			if(folders[number][3].length>0){
				output+="<tr valign=middle height=15 valign=top><td align=right width=60><? echo $content[$lang]["msgs"][19]; ?>:</td><td>"+folders[number][2]+"</td></tr>"
			}
			output+="<tr valign=middle height=15 valign=top><td align=right width=60><? echo $content[$lang]["msgs"][20]; ?>:</td><td>"+folders[number][3]+"</td></tr>"
			output+="</table>"
		}
	}else if(folders.length+files.length==0){
		output+="<? echo $content[$lang]["msgs"][23]; ?>"
	}else{
		output+="<? echo $content[$lang]["msgs"][24]; ?>"
	}
	explainLayer.innerHTML=output
}

function refreshContents(){
<?
	if($mode=="bigIcons"){
?>
	var i
	var j=0
	var jump=parseInt((d_w-280)/120)
	var output="<table cellpadding=5 cellspacing=5><tr valign=top>"
	for(i=0;i<folders.length;i++){
		output+="<td width=100 align=center><a onmouseover=explain('folder',"+i+") onmouseout=explain() href=\"javascript:action('go','"+escapeSlashes(folders[i][0])+"','')\"><img src=img/folder.gif border=0><br><br>"+((folders[i][0]=='..')?'<? echo $content[$lang]["msgs"][25]; ?></a>':(safePrint(folders[i][0])+"</a><br><br><a onmouseover=explain('folder',"+i+") onmouseout=explain() href=\"javascript:var tmp=window.prompt('<? echo $content[$lang]["msgs"][26]; ?>','"+escapeSlashes(folders[i][0])+"');if(tmp!=null){action('rn','"+escapeSlashes(folders[i][0])+"',tmp)}\"><? echo $content[$lang]["msgs"][27]; ?></a><br><a onmouseover=explain('folder',"+i+") onmouseout=explain() href=\"javascript:var tmp=window.prompt('<? echo $content[$lang]["msgs"][28]; ?>','"+escapeSlashes(folders[i][3])+"');if(tmp!=null){action('perm','"+escapeSlashes(folders[i][0])+"',tmp)}\"><? echo $content[$lang]["msgs"][29]; ?></a><br><a onmouseover=explain('folder',"+i+") onmouseout=explain() href=\"javascript:if(window.confirm('<? echo $content[$lang]["msgs"][30]; ?> ?')){action('rmdir','"+escapeSlashes(folders[i][0])+"','')}\"><? echo $content[$lang]["msgs"][31]; ?></a>"))+"<br><br>&nbsp;</td>"
		j++
		if(!(j%jump)){ output+="</tr><tr valign=top>" }
	}
	for(i=0;i<files.length;i++){
		output+="<td width=100 align=center><a onmouseover=explain('file',"+i+") onmouseout=explain() href=\"javascript:action('down','"+escapeSlashes(files[i][0])+"','')\"><img src=img/file.gif border=0><br><br>"+safePrint(files[i][0])+"</a><br><br><a onmouseover=explain('file',"+i+") onmouseout=explain() href=\"javascript:var tmp=window.prompt('<? echo $content[$lang]["msgs"][26]; ?>','"+escapeSlashes(files[i][0])+"');if(tmp!=null){action('rn','"+escapeSlashes(files[i][0])+"',tmp)}\"><? echo $content[$lang]["msgs"][27]; ?></a><br><a onmouseover=explain('file',"+i+") onmouseout=explain() href=\"javascript:var tmp=window.prompt('<? echo $content[$lang]["msgs"][28]; ?>','"+escapeSlashes(files[i][4])+"');if(tmp!=null){action('perm','"+escapeSlashes(files[i][0])+"',tmp)}\"><? echo $content[$lang]["msgs"][29]; ?></a><br><a onmouseover=explain('file',"+i+") onmouseout=explain() href=\"javascript:if(window.confirm('<? echo $content[$lang]["msgs"][32]; ?> ?')){action('rm','"+escapeSlashes(files[i][0])+"','')}\"><? echo $content[$lang]["msgs"][31]; ?></a><br><br>&nbsp;</td>"
		j++
		if(!(j%jump)){ output+="</tr><tr valign=top>" }
	}
<?
	}else{
?>
	var i
	var color="#ffffff"
	var output="<table cellpadding=10 cellspacing=0 width=100%>"
	output+="<tr valign=middle><td width=20></td><td><b><? echo $content[$lang]["msgs"][33]; ?></b></td><td align=center width=80><b><? echo $content[$lang]["msgs"][17]; ?></b></td><td align=center width=80><b><? echo $content[$lang]["msgs"][18]; ?></b></td><td align=center width=80><b><? echo $content[$lang]["msgs"][19]; ?></b></td><td align=center width=80><b><? echo $content[$lang]["msgs"][20]; ?></b></td></tr>"
	for(i=0;i<folders.length;i++){
		if(color=="#ffffff"){color="#f1f2f3"}else{color="#ffffff"}
		output+="<tr valign=middle bgcolor="+color+"><td align=center><img src=img/folder_small.gif></td><td><a onmouseover=explain('folder',"+i+") onmouseout=explain() href=\"javascript:action('go','"+escapeSlashes(folders[i][0])+"','')\"><b>"+((folders[i][0]=='..')?'<? echo $content[$lang]["msgs"][25]; ?></a></td><td></td><td></td><td></td><td></td>':(safePrint(folders[i][0])+"</b></a><br><a onmouseover=explain('folder',"+i+") onmouseout=explain() href=\"javascript:var tmp=window.prompt('<? echo $content[$lang]["msgs"][26]; ?>','"+escapeSlashes(folders[i][0])+"');if(tmp!=null){action('rn','"+escapeSlashes(folders[i][0])+"',tmp)}\"><? echo $content[$lang]["msgs"][27]; ?></a> &nbsp; <a onmouseover=explain('folder',"+i+") onmouseout=explain() href=\"javascript:if(window.confirm('<? echo $content[$lang]["msgs"][30]; ?> ?')){action('rmdir','"+escapeSlashes(folders[i][0])+"','')}\"><? echo $content[$lang]["msgs"][31]; ?></a></td><td></td><td align=center>"+folders[i][1]+"</td><td align=center>"+folders[i][2]+"</td><td align=center><a onmouseover=explain('folder',"+i+") onmouseout=explain() href=\"javascript:var tmp=window.prompt('<? echo $content[$lang]["msgs"][28]; ?>','"+escapeSlashes(folders[i][3])+"');if(tmp!=null){action('perm','"+escapeSlashes(folders[i][0])+"',tmp)}\">"+folders[i][3]+"</a></td>"))+"</tr>"}
	for(i=0;i<files.length;i++){
		if(color=="#ffffff"){color="#f1f2f3"}else{color="#ffffff"}
		output+="<tr valign=middle bgcolor="+color+"><td align=center><img src=img/file_small.gif></td><td><a onmouseover=explain('file',"+i+") onmouseout=explain() href=\"javascript:action('down','"+escapeSlashes(files[i][0])+"','')\"><b>"+safePrint(files[i][0])+"</b></a><br><a onmouseover=explain('file',"+i+") onmouseout=explain() href=\"javascript:var tmp=window.prompt('<? echo $content[$lang]["msgs"][26]; ?>','"+escapeSlashes(files[i][0])+"');if(tmp!=null){action('rn','"+escapeSlashes(files[i][0])+"',tmp)}\"><? echo $content[$lang]["msgs"][27]; ?></a> &nbsp; <a onmouseover=explain('file',"+i+") onmouseout=explain() href=\"javascript:if(window.confirm('<? echo $content[$lang]["msgs"][32]; ?> ?')){action('rm','"+escapeSlashes(files[i][0])+"','')}\"><? echo $content[$lang]["msgs"][31]; ?></a></td><td align=center>"+files[i][2]+"</td><td align=center>"+files[i][1]+"</td><td align=center>"+files[i][3]+"</td><td align=center><a onmouseover=explain('file',"+i+") onmouseout=explain() href=\"javascript:var tmp=window.prompt('<? echo $content[$lang]["msgs"][28]; ?>','"+escapeSlashes(files[i][4])+"');if(tmp!=null){action('perm','"+escapeSlashes(files[i][0])+"',tmp)}\">"+files[i][4]+"</a></td></tr>"}
<?
	}
?>
	output+="</table>"
	mainLayer.innerHTML=output
}

var d_w=0
var navDOM=document.body.clientHeight

var explainLayer=bul("description")
var leftLayer=bul("leftFrame")
var mainLayer=bul("content")

var folders=new Array()
var files=new Array()

<?

	if(strlen($curFold)>1){
		echo "folders[folders.length]=[\"..\"]\n";
	}

	for($i=0;$i<sizeof($folders);$i++){
		echo "folders[folders.length]=[\"".addslashes(filterHTML($folders[$i]))."\",\"".addslashes(filterHTML($foldLastMod[$i]))."\",\"".addslashes(filterHTML($foldOwner[$i]))."\",\"".addslashes(filterHTML($foldPerm[$i]))."\"]\n";
	}
	for($i=0;$i<sizeof($files);$i++){
		$currentFileSize=$fileSizes[$i]/1048576;
		if($currentFileSize<1){
			$currentFileSize*=1024;
			$currentFileSize=substr("$currentFileSize",0,strpos("$currentFileSize",".")+3)." KB";
		}elseif($currentFileSize>1024){
			$currentFileSize/=1024;
			$currentFileSize=substr("$currentFileSize",0,strpos("$currentFileSize",".")+3)." GB";
		}else{
			$currentFileSize=substr("$currentFileSize",0,strpos("$currentFileSize",".")+3)." MB";
		}
		echo "files[files.length]=[\"".addslashes(filterHTML($files[$i]))."\",\"".addslashes(filterHTML($fileLastMod[$i]))."\",\"$currentFileSize\",\"".addslashes(filterHTML($fileOwner[$i]))."\",\"".addslashes(filterHTML($filePerm[$i]))."\"]\n";
	}

?>

if(explainLayer && mainLayer && leftLayer){
	explain()
	window.onload=markMe
	window.onresize=markMe
	setInterval("markMe()",2000)
}

function onSelectStart() {
	if( window.event.srcElement.tagName != "INPUT" ) {
		window.event.returnValue = false
		window.event.cancelBubble = true
	}
}

document.onselectstart=onSelectStart
</script>
<?
				}else{

					// Connection to the FTP server has failed
					ftp_quit($conn_id);
					session_name("sessID");
					session_id($sessID);
					session_start();
					session_unset();
					session_write_close();
					session_start();
					session_destroy();
					setcookie(session_name(),"",0,"/");
					login_form($content[$lang]["errorlist"][9]);
				}
		}else{
			// IP mismatch... Session needs to be destroyed...
			if($sessID){
				session_name("sessID");
				session_id($sessID);
				session_start();
				session_unset();
				session_write_close();
				session_start();
				session_destroy();
				setcookie(session_name(),"",0,"/");
			}
			if(strlen($sessInfo["ip"])>0){
				login_form($content[$lang]["errorlist"][10]);
			}else{
				login_form($content[$lang]["errorlist"][11]);
			}
		}
	}
}else{
	// The user didn't have any session ID, so is trying to log in
	login_form();
}

// Compress output and send it
if(ZIP_IT && !headers_sent()){
	header('Content-Encoding: gzip');
	$gzip_contents=ob_get_contents();
	ob_end_clean();

	$gzip_size=strlen($gzip_contents);
	$gzip_crc=crc32($gzip_contents);

	$gzip_contents=gzcompress($gzip_contents,9);
	$gzip_contents=substr($gzip_contents,0,strlen($gzip_contents)-4);

	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
	echo $gzip_contents;
	echo pack('V',$gzip_crc);
	echo pack('V',$gzip_size);
}else{
	ob_end_flush();
}

?>
