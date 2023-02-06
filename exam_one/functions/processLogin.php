<?php

function processLogin(): bool
{
  $data = [
    'email' => htmlspecialchars(trim($_POST['email'])) ?? '',
    'password' => trim($_POST['password']) ?? ''
  ];

  if (file_exists('./../database/users.json')) {
    $json = json_decode(file_get_contents('./../database/users.json'), true);
  } else {
    $json = ['users' => []];
  }

  $found = false;

  // Check if user exists
  foreach ($json['users'] as $user) {
    if ((isset($user['username']) && $user['username'] == $data['email']) ||
      (isset($user['email']) && $user['email'] == $data['email'])
    ) {
      if (password_verify($data['password'], $user['password'])) {
        $found = true;

        $user['type'] === 0 ? $_SESSION['admin'] = $user['username'] :
          $_SESSION['username'] = $user['username'];

        break;
      }
    }
  }

  return $found;
}
