<?php
/**
 *@author nicolaas [at] sunnysideup.co.nz
 * @package sapphire
 * @subpackage email
 */

class TestMailerToFile extends Mailer
{

    private static $show_all_details = false;

    private static $file_to_write_to = "assets/emails.txt";

    private static $separation_string = "
-------------------------------------------------------------------------------------------------------------------------------------";

    /**
     * Send a plain-text email
     */
    public function sendPlain($to, $from, $subject, $plainContent, $attachedFiles = false, $customheaders = false)
    {
        if ($this->Config()->get("show_all_details")) {
            $string = "
~TO: $to ~
~FROM: $from ~
~SUBJECT: $subject ~
~PLAINTEXT: $plainContent ~
~ATTACHEDFILES: ".print_r($attachedFiles, 1)." ~
~CUSTOMHEADERS: ".print_r($customheaders, 1)." ~";
        } else {
            $string = "
~PLAINTEXT: TRUE
~TO: $to ~
~FROM: $from ~
~SUBJECT: $subject ~";
        }
        $this->writeToFile($string);
        return true;
    }

    /**
     * Send a multi-part HTML email
     */
    public function sendHTML($to, $from, $subject, $htmlContent, $attachedFiles = false, $customheaders = false, $plainContent = false, $inlineImages = false)
    {
        if ($this->Config()->get("show_all_details")) {
            $string = "
~TO: $to ~
~FROM: $from ~
~SUBJECT: $subject ~
~HTMLCONTENT: $htmlContent ~
~ATTACHEDFILES: ".print_r($attachedFiles, 1)." ~
~CUSTOMHEADERS: ".print_r($customheaders, 1)." ~
~PLAINTEXT: $plainContent ~
~INLINEIMAGES: $inlineImages ~";
        } else {
            $string = "
~PLAINTEXT: FALSE
~TO: $to ~
~FROM: $from ~
~SUBJECT: $subject ~";
        }
        $this->writeToFile($string);
        return true;
    }

    protected function writeToFile($string)
    {
        $myFile = Director::baseFolder()."/".self::$file_to_write_to;
        $fh = fopen($myFile, 'a') or die("can't open file $myFile");
        $stringData = self::$separation_string.$string;
        fwrite($fh, $stringData);
        fclose($fh);
    }
}
