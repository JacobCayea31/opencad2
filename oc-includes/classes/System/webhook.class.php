<?php

namespace System;

class Webhook extends \Dbh
{
    public function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function getWebhookById($id)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "webhooks WHERE id=?");
        if (!$stmt->execute(array(htmlspecialchars($id)))) {
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

    public function verifyWebhookURI($uri)
    {
        if (filter_var($uri, FILTER_VALIDATE_URL) === false) {
            // not valid
            return false;
        } else {
            // valid
            return true;
        }
    }

    public function submitWebhook()
    {
        $config_data = new Config();
        $title = $_POST["webhook_title"];
        $json = json_encode($_POST["json_data"]);
        $type = $_POST["webhook_settings"];
        $uri = $_POST["webhook_uri"];
        if (isset($_POST["webhook_activation"])) {
            $settings = $_POST["webhook_activation"];
            $settings = implode(", ", $settings);
        } else {
            $settings = "NULL";
        };

        $uri = $config_data->encryptString($uri);
        $stmt = $this->connect()->prepare("INSERT INTO " . DB_PREFIX . "webhooks (webhook_title, webhook_uri, webhook_json, webhook_type, webhook_settings) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt->execute(array($title, $uri, $json, $type, $settings))) {
            $_SESSION['error'] = $stmt->errorInfo();

            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            do_hook('webhook_inserted_success', $title, $json, $type, $config_data->decrpytString($uri), $settings);
            return $results;
        }
    }

    public function updateWebook()
    {
        $config_data = new Config();

        $title = $_POST["webhook_title"];
        $json = json_encode($_POST["json_data"]);
        $type = $_POST["webhook_settings"];
        $uri = $config_data->encryptString($_POST["webhook_uri"]);
        $id = $_POST["webhook_id"];
        if (isset($_POST["webhook_activation"])) {
            $settings = $_POST["webhook_activation"];
            $settings = implode(", ", $settings);
        } else {
            $settings = "NULL";
        };

        $stmt = $this->connect()->prepare("UPDATE ".DB_PREFIX."webhooks SET webhook_title = ?, webhook_uri = ?, webhook_json = ?, webhook_type = ?, webhook_settings = ? WHERE id = ?");
        if (!$stmt->execute(array($title, $uri, $json, $type, $settings, $id))) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            do_hook('webhook_edited_success', $title, $json, $type, $config_data->decrpytString($uri), $settings);
            return $results;
        }
    }



    public function getWebhooks()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "webhooks");
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

    public function deleteWebhook($id)
    {
        $stmt = $this->connect()->prepare("DELETE FROM " . DB_PREFIX . "webhooks WHERE id=?");
        if (!$stmt->execute(array($id))) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }
        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            do_hook('webhook_delete_success', $id);
            return $results;
        }
    }

    public function postWebhook($url, $payload)
    {
        $curl = curl_init();
        $url = $url;
        $json = json_decode($payload);

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $json,
        ]);

        $response = curl_exec($curl);

        if ($error = curl_error($curl)) {
            echo $error;
        }

        curl_close($curl);
        $response = json_decode($response, true);
        do_hook('webhook_post_succcess', $response);

        return 'Response: ' . $response;
    }

    public function getWebhookSetting($query)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "webhooks WHERE webhook_settings LIKE \"%$query%\"");
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
}