<?php

return [
  'php' => [
      'version' => '7.4.0',
      'extension' => ['bcmath', 'ctype', 'fileinfo', 'gd', 'json', 'mbstring', 'openssl', 'PDO', 'tokenizer', 'xml'],
      'permissions' => [
          'bootstrap/cache' => '775',
          'storage/app' => '775',
          'storage/framework' => '775',
          'storage/logs' => '775'
      ],
  ]
];
