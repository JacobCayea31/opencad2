<?php

namespace System;

class Support extends \Dbh
{

    public function submitBug($key, $array)
    {
        // TO BE DELETED AND HAVE MAIN REPO SET FOR FINAL RELEASE
        if(!OC_DEVELOP){
            $URL = "https://api.github.com/repos/opencad-app/OpenCAD-php/issues";
        } else{
            $URL = "https://api.github.com/repos/kevingorman1000/OpenCad-Versions-TEMP/issues";
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'OpenCad');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array);

        $headers = array();
        $headers[] = 'Accept: application/vnd.github+json';
        $headers[] = 'Authorization: token '. $key;
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result=json_decode(curl_exec($ch),true);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    public function createKey($value)
    {
        $config_data = new Config();
        $key = "gh_key";
        $value = $config_data->encryptString($value);

        $stmt = $this->connect()->prepare("INSERT INTO " . DB_PREFIX . "config (`key`, `value`) VALUES (?, ?)");
        if (!$stmt->execute(array($key, $value))) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

   

    

    public function checkKey($key)
    {
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/user');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_USERAGENT, 'OpenCad');
        $headers = array();
        $headers[] = 'Accept: application/vnd.github+json';
        $headers[] = 'Authorization: token ' . $key;
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    public function checkRow()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "config WHERE `key`='gh_key'");
        if (!$stmt->execute()) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    public function getKey()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "config WHERE `key`='gh_key'");
        if (!$stmt->execute()) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            foreach ($results as $result) {
                return $result;
            }
        }
    }
    
    public function getIssues($key)
    {
        // TO BE DELETED AND HAVE MAIN REPO SET FOR FINAL RELEASE
        if(!OC_DEVELOP){
            $URL = "https://api.github.com/repos/opencad-app/OpenCAD-php/issues";
        } else{
            $URL = "https://api.github.com/repos/kevingorman1000/OpenCad-Versions-TEMP/issues";
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'OpenCad');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Accept: application/vnd.github+json';
        $headers[] = 'Authorization: token '. $key;
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result=json_decode(curl_exec($ch),true);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    public function getUserDetails($key)
    {
        // TO BE DELETED AND HAVE MAIN REPO SET FOR FINAL RELEASE
        $URL = "https://api.github.com/user";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'OpenCad');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Accept: application/vnd.github+json';
        $headers[] = 'Authorization: token '. $key;
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result=json_decode(curl_exec($ch),true);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    public function getIssuesByID($key, $id)
    {
        // TO BE DELETED AND HAVE MAIN REPO SET FOR FINAL RELEASE
        if(!OC_DEVELOP){
            $URL = "https://api.github.com/repos/opencad-app/OpenCAD-php/issues/".$id."/comments";
        } else{
            $URL = "https://api.github.com/repos/kevingorman1000/OpenCad-Versions-TEMP/issues/".$id."/comments";
        }


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'OpenCad');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Accept: application/vnd.github+json';
        $headers[] = 'Authorization: token '. $key;
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result=json_decode(curl_exec($ch),true);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }
}
