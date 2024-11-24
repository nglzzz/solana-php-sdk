<?php

/**
 * This file is part of the Solana PHP SDK.
 *
 * (c) Joseph Opanel <opanelj@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace JosephOpanel\SolanaSDK\Endpoints\JsonRPC;

use JosephOpanel\SolanaSDK\SolanaRPC;

class Account {
    private $rpc;

    public function __construct(SolanaRPC $rpc) {
        $this->rpc = $rpc;
    }

    public function getAccountInfo(string $publicKey): array {
        return $this->rpc->call('getAccountInfo', [$publicKey]);
    }

    public function getBalance(string $publicKey, string $commitment = 'finalized'): array {
        return $this->rpc->call('getBalance', [$publicKey, ['commitment' => $commitment]]);
    }

    public function getMultipleAccounts(array $addresses, array $config = []): array {
        $params = [$addresses];
        if (!empty($config)) {
            $params[] = $config;
        }
        return $this->rpc->call('getMultipleAccounts', $params);
    }

    public function getProgramAccounts(string $programId, array $config = []): array {
        $params = [$programId];
        if (!empty($config)) {
            $params[] = $config;
        }
        return $this->rpc->call('getProgramAccounts', $params);
    }

    public function getTokenAccountBalance(string $address, string $commitment = 'finalized'): array {
        $response = $this->rpc->call('getTokenAccountBalance', [$address, ['commitment' => $commitment]]);
        return $response ?? []; // Return the response or an empty array
    }

    public function getTokenAccountsByDelegate(string $delegate, array $config = []): array {
        $params = [$delegate];
        if (!empty($config)) {
            $params[] = $config;
        }
        return $this->rpc->call('getTokenAccountsByDelegate', $params);
    }

    public function getTokenAccountsByOwner(string $owner, array $config = []): array {
        $params = [$owner];
        if (!empty($config)) {
            $params[] = $config;
        }
        return $this->rpc->call('getTokenAccountsByOwner', $params);
    }

    public function getTokenLargestAccounts(string $mint, string $commitment = 'finalized'): array {
        $response = $this->rpc->call('getTokenLargestAccounts', [$mint, ['commitment' => $commitment]]);
        return $response['value'] ?? []; // Safely return the 'value' key or an empty array
    }

    public function getTokenSupply(string $mint, string $commitment = 'finalized'): array {
        $response = $this->rpc->call('getTokenSupply', [$mint, ['commitment' => $commitment]]);
        return $response['value'] ?? []; // Safely return the 'value' key or an empty array
    }






}
