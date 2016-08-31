<?php
ini_set('max_execution_time', 300);
function _error() {
    $args = func_get_args();
    if(count($args) > 1) {
        $title = $args[0];
        $message = $args[1];
    } else {
        switch ($args[0]) {
            case 'DB_ERROR':
                $title = "Database Error";
                $message = "<div class='text-left'><h1>"."Error establishing a database connection"."</h1>
                            <p>"."This either means that the username and password information in your config.php file is incorrect or we can't contact the database server at localhost. This could mean your host's database server is down."."</p>
                            <ul>
                                <li>"."Are you sure you have the correct username and password?"."</li>
                                <li>"."Are you sure that you have typed the correct hostname?"."</li>
                                <li>"."Are you sure that the database server is running?"."</li>
                            </ul>
                            <p><a style='width: 100%;'' class='fs-submit' href=".baseDomain()."install >Try Again </a></p>
                            </div>";
                break;

            case 'SQL_ERROR':
                $title = __("Database Error");
                $message = "<p>".__("An error occurred while writing to database. Please try again later")."</p>";
                break;

            case 'SQL_ERROR_THROWEN':
                throw new Exception(__("An error occurred while writing to database. Please try again later"));
                break;

            case '404':
                header('HTTP/1.0 404 Not Found');
                $title = __("404 Not Found");
                $message = "<p>".__("The requested URL was not found on this server. That's all we know")."</p>";
                break;

            case '400':
                header('HTTP/1.0 400 Bad Request');
                exit;

            case '403':
                header('HTTP/1.0 403 Access Denied');
                exit;
            
            default:
                $title = __("Error");
                $message = "<p>".__("There is some thing went wrong")."</p>";
                break;
        }
    }
    echo '<!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <title>'.$title.'</title>
                <style type="text/css">
                    html {
                        background: #f1f1f1;
                    }
                    body {
                        color: #555;
                        font-family: "Open Sans", Arial,sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .error-title {
                        background: #ce3426;
                        color: #fff;
                        text-align: center;
                        font-size: 34px;
                        font-weight: 100;
                        line-height: 50px;
                        padding: 60px 0;
                    }
                    .error-message {
                        margin: 1em auto;
                        padding: 1em 2em;
                        max-width: 600px;
                        font-size: 1em;
                        line-height: 1.8em;
                        text-align: center;
                    }
                    .error-message .code,
                    .error-message p {
                        margin-top: 0;
                        margin-bottom: 1.3em;
                    }
                    .error-message .code {
                        font-family: Consolas, Monaco, monospace;
                        background: rgba(0, 0, 0, 0.7);
                        padding: 10px;
                        color: rgba(255, 255, 255, 0.7);
                        word-break: break-all;
                        border-radius: 2px;
                    }
                    h1 {
                        font-size: 1.2em;
                    }
                    
                    ul li {
                        margin-bottom: 1em;
                        font-size: 0.9em;
                    }
                    a {
                        color: #ce3426;
                        text-decoration: none;
                    }
                    a:hover {
                        text-decoration: underline;
                    }
                    .button {
                        background: #f7f7f7;
                        border: 1px solid #cccccc;
                        color: #555;
                        display: inline-block;
                        text-decoration: none;
                        margin: 0;
                        padding: 5px 10px;
                        cursor: pointer;
                        -webkit-border-radius: 3px;
                        -webkit-appearance: none;
                        border-radius: 3px;
                        white-space: nowrap;
                        -webkit-box-sizing: border-box;
                        -moz-box-sizing:    border-box;
                        box-sizing:         border-box;

                        -webkit-box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0,0,0,.08);
                        box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0,0,0,.08);
                        vertical-align: top;
                    }

                    .button.button-large {
                        height: 29px;
                        line-height: 28px;
                        padding: 0 12px;
                    }

                    .button:hover,
                    .button:focus {
                        background: #fafafa;
                        border-color: #999;
                        color: #222;
                        text-decoration: none;
                    }

                    .button:focus  {
                        -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,.2);
                        box-shadow: 1px 1px 1px rgba(0,0,0,.2);
                    }

                    .button:active {
                        background: #eee;
                        border-color: #999;
                        color: #333;
                        -webkit-box-shadow: inset 0 2px 5px -3px rgba( 0, 0, 0, 0.5 );
                        box-shadow: inset 0 2px 5px -3px rgba( 0, 0, 0, 0.5 );
                    }
                    .text-left {
                        text-align: left;
                    }
                    .text-center {
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="error-title">'.$title.'</div>
                <div class="error-message">'.$message.'</div>
            </body>
            </html>';
    exit;
}


/**
 * Check for the required extensions to run
 *
 * Dies if requirements are not met.
 * 
 * @return void
 */
function _check_requirements() {
    $required_mysql_version = 5.0;
    $required_php_version = 5.4;
    /* check php version */
    $php_version = phpversion();
    if(version_compare( $required_php_version, $php_version, '>')) {
        _error("Installation Error", sprintf('<p class="text-center">Your server is running PHP version %1$s but PHPTravels %2$s requires at least %3$s.</p>', $php_version, '5.3', $required_php_version));
    }
    /* check mysql version */
    if(!extension_loaded('mysql')) {
        _error("Installation Error", '<p class="text-center">Your PHP installation appears to be missing the "MySQL" extension which is required by PHPTravels.</p><small>Back to your server admin or hosting provider to enable it for you</small>');
    }
    /* check if mysqli enabled */
    if(!extension_loaded('mysqli')) {
        _error("Installation Error", '<p class="text-center">Your PHP installation appears to be missing the "mysqli" extension which is required by PHPTravels.</p><small>Back to your server admin or hosting provider to enable it for you</small>');
    }
    /* check if curl enabled */
    if(!extension_loaded('curl')) {
        _error("Installation Error", '<p class="text-center">Your PHP installation appears to be missing the "cURL" extension which is required by PHPTravels.</p><small>Back to your server admin or hosting provider to enable it for you</small>');
    }
    /* check if json_decode enabled */
    if(!function_exists('json_decode')) {
        _error("Installation Error", '<p class="text-center">Your PHP installation appears to be missing the "json_decode()" function which is required by PHPTravels.</p><small>Back to your server admin or hosting provider to enable it for you</small>');
    }

    if(!is_writable('../uploads')) {
        _error("Installation Error", '<p class="text-center">"uploads" folder must be writable.');
    }

    if(!function_exists('mb_internal_encoding')) {
        _error("Installation Error", '<p class="text-center">Your PHP installation appears to be missing the "mb_internal_encoding()" function which is required by PHPTravels.</p><small>Back to your server admin or hosting provider to enable it for you</small>');
    }
    $maxUpload = (int)(ini_get('upload_max_filesize'));
    if($maxUpload < 2) {
        _error("Installation Error", '<p class="text-center">upload_max_filesize must be greater than or equal to 2MB.');
    }

    $maxPost = (int)(ini_get('post_max_size'));
    if($maxPost < 8) {
        _error("Installation Error", '<p class="text-center">post_max_size must be greater than or equal to 8MB.');
    }

}

/**
 * _redirect
 * 
 * @param string $url
 * @return void
 */
function _redirect($url = null) {
    if($url) {
        header('Location: '.$url);
    } 
    exit;
}


/* ------------------------------- */
/* Security */
/* ------------------------------- */

/**
 * secure
 * 
 * @param string $value
 * @param string $type
 * @param string $quoted
 * @return string
 */
function secure($value, $type = "", $quoted = true) {
    if($value !== 'null') {
        $value = sanitize($value);
        $value = safe_sql($value, $type, $quoted);
    } else {
        $value = 'null';
    }
    return $value;
}


/**
 * sanitize
 * 
 * @param string $value
 * @return string
 */
function sanitize($value) {
    if(get_magic_quotes_gpc()) $value = stripslashes($value);
    return htmlentities($value, ENT_QUOTES, 'utf-8');
}


/**
 * safe_sql
 * 
 * @param string $value
 * @param string $type
 * @param string $quoted
 * @return string
 */
function safe_sql($value, $type = "", $quoted = true) {
    global $db;
    $value = $db->real_escape_string($value);
    switch ($type) {
        case 'int':
            $value = ($quoted)? "'".intval($value)."'" : intval($value);
            break;

        case 'search':
            if($quoted) {
                $value = (!empty($value)) ? "'%".$value."%'" : "''";
            } else {
                $value = (!empty($value)) ? "'%%".$value."%%'" : "''";
            }
            break;
        
        default:
            $value = (!empty($value)) ? "'".$value."'" : "''";
            break;
    }
    return $value;
}


/**
 * is_empty
 * 
 * @param string $value
 * @return boolean
 */
function is_empty($value) {
    if(strlen(trim(preg_replace('/\xc2\xa0/',' ',$value))) == 0) {
        return true;
    }else {
        return false;
    }
}


/**
 * valid_email
 * 
 * @param string $email
 * @return boolean
 */
function valid_email($email) {
    if(preg_match("/^[0-9a-z]+(([\.\-_])[0-9a-z]+)*@[0-9a-z]+(([\.\-])[0-9a-z-]+)*\.[a-z]{2,4}$/i", $email)) {
        return true;
    }else {
        return false;
    }
}


/**
 * valid_username
 * 
 * @param string $string
 * @return boolean
 */
function valid_username($string) {
    if(strtolower($string) != 'admin' && strlen($string) >= 3 && preg_match('/^[a-zA-Z0-9]+([_|.]?[a-zA-Z0-9])*$/', $string)) {
        return true;
    }else {
        return false;
    }
}


  function baseDomain(){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $tmplt = "%s://%s%s";
            $end = $dir;
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        return str_replace("/install","",$base_url);
    }


// Function to write the config file
    function write_config($data) {

        // Config path
        $template_path  = 'database.php';
        $output_path    = '../database.php';

        // Open the file
        $database_file = file_get_contents($template_path);

        $new  = str_replace("%HOSTNAME%",$data['db_host'],$database_file);
        $new  = str_replace("%USERNAME%",$data['db_username'],$new);
        $new  = str_replace("%PASSWORD%",$data['db_password'],$new);
        $new  = str_replace("%DATABASE%",$data['db_name'],$new);

        // Write the new database.php file
        $handle = fopen($output_path,'w+');

        // Chmod the file, in case the user forgot
        @chmod($output_path,0777);

        // Verify file permissions
        if(is_writable($output_path)) {

            // Write the file
            if(fwrite($handle,$new)) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }


    function sendEmail($postData){
        $domainUrl = $postData['domain'];
        $sitemapUrl = $postData['domain'].'sitemap.xml';
        $adminUrl = $postData['domain'].'admin';
        $adminEmail = $postData['admin_email'];
        $adminPass = $postData['admin_password'];
        $message = '<body style="font-family: Arial,Helvetica,sans-serif; background: #ebebeb"; padding: 0;">
                    <table style="margin:0px; border-radius:8px;padding:50px" cellpadding="0" cellspacing="0" width="640" align="center">
                    <tbody>
                    <tr>
                    <td valign="top" colspan="3" style="background: #fbfbfb;margin-top:20px;border-radius:5px">
                    <table cellpadding="0" cellspacing="0" width="640" align="center">
                    <tbody>
                    <tr>
                    <td>
                    <div style="padding:20px">
                    <table>
                    <tbody>
                    <tr>
                    <td>
                    <div width="50" style="border-radius:4px;background-color: #1e65dd; width: 30px; min-height: 30px;"></div>
                    </td>
                    <td style=""><a style="font-size:30px;font-weight:bold;text-decoration: none;color:#000000" href="'.$domainUrl.'" target="_blank"> PHPTRAVELS </a></td>
                    </tr>
                    </tbody>
                    </table>
                    </div>
                    </td>
                    </tr>
                    <tr>
                    <td valign="top" colspan="3">
                    <div style="
                    background: rgb(30, 101, 221); /* Old browsers */
                    width: 675px; min-height: 6px;"></div>
                    </td>
                    </tr>
                    <td style="background: #ffffff; padding:10px; width:100%">';

        $message .= '<h3><strong>Hey Buddy!</strong></h3>
        <div class="col-md-4">
        <p class="alert alert-success text-center">Congratulations PHPTRAVELS installed successfully and ready to get started.</p>
        </div>
        <br>
        <hr>';

        $message .= "<a href=$adminUrl target='_blank'>
        <h4 style='width: 100%; border-radius: 5px; border: 1px; font-size: 16px; cursor: pointer; background-color: #E6E6E6;'>Administrator</h4>
        </a><br>";
        $message .= "<strong>Email : $adminEmail </strong> <br>
        <strong>Password :</strong> $adminPass <br>";

        $message .= "<p><strong>XML Sitemap For better SEO</strong></p>
        <p><a target='_blank' href= $sitemapUrl > $sitemapUrl </a></p>
        <p>------------------------------------------</p>
        <p>to get started and setup the website please visit here <a target='_blank' href='//phptravels.com/documentation/'><strong>www.phptravels.com/documentation/</strong> </a></p>
        <p>Looking forward to hearing from you.</p>
        <hr>
        <p><span><strong>Regards</strong></span><br>
        PHPTRAVELS Team
        </p>" ; 

        $message .= '</td>
        </tbody></table>
        <table width="100%" height="50" style="border-radius:0px 0px 5px 5px" bgcolor="#2E2E2E">
        <tbody>
        <tr>
        <td>
        <center>
        <a style="color:#FFFFFF;text-decoration:none;font-size:12px" href="#" target="_blank">'.$postData['siteTitle'].'</a>
        </center>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        <td style="color:rgb(169, 169, 169);font-size:12px; width:100%">
        <br>
        <b>Disclaimer:</b> This e-mail and any attachments are confidential and may be protected by legal privilege. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of this e-mail or any attachment is prohibited. If you have received this e-mail in error, please notify us immediately by returning it to the sender and delete this copy from your system. Thank you for your cooperation.
        </td>
        </tbody>
        </table>
        </body>';

        $subject = "Installation Details";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <'.$adminEmail.'>' . "\r\n";

        mail($adminEmail,$subject,$message,$headers);

    }