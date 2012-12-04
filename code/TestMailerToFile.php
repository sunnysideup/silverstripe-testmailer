<?php
/**
 *@author nicolaas [at] sunnysideup.co.nz
 * @package sapphire
 * @subpackage email
 */

class TestMailerToFile extends Mailer  {

	protected static $file_to_write_to = "assets/emails.txt";
		static function set_file_to_write_to ($v) {self::$file_to_write_to = $v;}

	protected static $separation_string = "\r\nr\n
	-------------------------------------------------------------------------------------------------------------------------------------
	\r\nr\n";
		static function set_separation_string ($v) {self::$separation_string = $v;}
	/**
	 * Send a plain-text email
	 */
	function sendPlain($to, $from, $subject, $plainContent, $attachedFiles = false, $customheaders = false) {
		$string = "\r\n
~TO: $to ~ \r\n
~FROM: $from ~ \r\n
~SUBJECT: $subject ~ \r\n
~PLAINTEXT: $plainContent ~ \r\n
~ATTACHEDFILES: $attachedFiles ~ \r\n
~CUSTOMHEADERS: $customheaders ~";
		$this->writeToFile($string);
	}

	/**
	 * Send a multi-part HTML email
	 */
	function sendHTML($to, $from, $subject, $htmlContent, $attachedFiles = false, $customheaders = false, $plainContent = false, $inlineImages = false) {
		$string = "\r\n
~TO: $to ~ \r\n
~FROM: $from ~ \r\n
~SUBJECT: $subject ~ \r\n
~HTMLCONTENT: $htmlContent ~ \r\n
~ATTACHEDFILES: $attachedFiles ~ \r\n
~CUSTOMHEADERS: $customheaders ~  \r\n
~PLAINTEXT: $plainContent ~ \r\n
~INLINEIMAGES: $inlineImages ~";
		$this->writeToFile($string);
	}

	function writeToFile($string) {
		$myFile = Director::baseFolder()."/".self::$file_to_write_to;
		$fh = fopen($myFile, 'a') or die("can't open file $myFile");
		$stringData = self::$separation_string.$string;
		fwrite($fh, $stringData);
		fclose($fh);
	}

}
