<?php

namespace App;

class Transaction {
    private $customerEmail;
    private $transactionDataFile = './data/transactions.json';

    public function __construct($customerEmail) {
        $this->customerEmail = $customerEmail;
    }

    private function loadTransactionData() {
        if (file_exists($this->transactionDataFile)) {
            $data = file_get_contents($this->transactionDataFile);
            $decodedData = json_decode($data, true);

            if ($decodedData === null) {
                echo json_last_error_msg();
                return [];
            }

            return $decodedData;
        }

        return [];
    }

    private function saveTransactionData($transactionData) {
        $encodedData = json_encode($transactionData, JSON_PRETTY_PRINT);
        file_put_contents($this->transactionDataFile, $encodedData);
    }

    public function viewTransactions() {
        $transactionData = $this->loadTransactionData();

        $customerTransactions = array_filter($transactionData, function ($transaction) {
            return $transaction['email'] === $this->customerEmail;
        });

        foreach ($customerTransactions as $transaction) {
            echo "Date: " . $transaction['date'] . "\n";
            echo "Amount: " . $transaction['amount'] . "\n";
            echo "Type: " . $transaction['type'] . "\n";
            echo "-----------------\n";
        }
    }

    public function deposit($amount) {
        $transactionData = $this->loadTransactionData();

        $transactionData[] = [
            'email' => $this->customerEmail,
            'date' => date('Y-m-d H:i:s'), 
            'amount' => $amount,
            'type' => 'deposit',
        ];

        $this->saveTransactionData($transactionData);

    }

    public function withdraw($amount) {
        $transactionData = $this->loadTransactionData();

        $transactionData[] = [
            'email' => $this->customerEmail,
            'date' => date('Y-m-d H:i:s'),
            'amount' => -$amount, 
            'type' => 'withdrawal',
        ];

        $this->saveTransactionData($transactionData);

    }

    public function transfer($recipientEmail, $amount) {
        $transactionData = $this->loadTransactionData();

        $transactionData[] = [
            'email' => $this->customerEmail,
            'date' => date('Y-m-d H:i:s'),
            'amount' => -$amount,
            'type' => 'transfer to ' . $recipientEmail,
        ];

        $transactionData[] = [
            'email' => $recipientEmail,
            'date' => date('Y-m-d H:i:s'),
            'amount' => $amount,
            'type' => 'transfer from ' . $this->customerEmail,
        ];

        $this->saveTransactionData($transactionData);

    }

    public function getCurrentBalance() {
        $transactionData = $this->loadTransactionData();

        $currentBalance = 0;
        foreach ($transactionData as $transaction) {
            if ($transaction['email'] === $this->customerEmail) {
                $currentBalance += $transaction['amount'];
            }
        }

        return $currentBalance;
    }
}
