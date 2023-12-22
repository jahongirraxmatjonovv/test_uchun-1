<?php

// Set your Telegram bot token and Shazam API key
$telegramBotToken = '1771937913:AAFe4xl7o6DView0xks1-5UmVwixMs5XgHY';
$shazamApiKey = '5559a815famshf702175d2320540p1b3d2ajsn80dfe2832baf';

// Get the incoming message from Telegram
$update = json_decode(file_get_contents('php://input'), true);
$message = $update['message']['text'];
$chatId = $update['message']['chat']['id'];

// Check if the message is a command
if (strpos($message, '/shazam') === 0) {
    // Extract the song name from the command
    $songName = trim(str_replace('/shazam', '', $message));

    // Make a request to the Shazam API
    $shazamUrl = "https://shazam.p.rapidapi.com/search";
    $headers = [
        'X-RapidAPI-Host: shazam.p.rapidapi.com',
        'X-RapidAPI-Key: ' . $shazamApiKey,
    ];
    $query = http_build_query(['term' => $songName]);

    $ch = curl_init($shazamUrl . '?' . $query);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Parse the Shazam API response
    $shazamData = json_decode($response, true);
    $tracks = $shazamData['tracks'];

    // Send the result back to the Telegram chat
    if (!empty($tracks)) {
        $firstTrack = $tracks[0];
        $title = $firstTrack['title'];
        $artist = $firstTrack['subtitle'];

        $replyMessage = "Shazam result:\nTitle: $title\nArtist: $artist";
    } else {
        $replyMessage = "No results found for '$songName' on Shazam.";
    }

    // Send the reply to Telegram
    $telegramApiUrl = "https://api.telegram.org/bot$telegramBotToken/sendMessage";
    $postData = [
        'chat_id' => $chatId,
        'text' => $replyMessage,
    ];

    $ch = curl_init($telegramApiUrl);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}
