<?php

$instructors = [
  'kareem fouad' => [
    'job' => 'backend developer',
    'track' => 'php',
  ],
  'ahmed bahnasy' => [
    'job' => 'frontend developer',
    'track' => 'angular',
  ],
  'ahmed nasr' => [
    'job' => 'backend developer',
    'track' => '.net',
  ],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <ul>
    <?php foreach ($instructors as $key => $value) : ?>

      <?php if (is_array($value)) : ?>
        <li>
          <?= $key ?>
          <ul>
            <?php foreach ($value as $k => $v) : ?>
              <li>
                <?= "$k: $v" ?>
              </li>
            <?php endforeach ?>
          </ul>
        </li>

      <?php else : ?>
        <li>
          <?= $key ?>
        </li>

      <?php endif; ?>

    <?php endforeach; ?>
  </ul>

</body>

</html>