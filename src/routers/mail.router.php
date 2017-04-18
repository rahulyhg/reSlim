<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    // POST example api to send mail
    $app->post('/mail/send', function (Request $request, Response $response) {      
        $mail = new classes\Mailer($this->mail);
        $datapost = $request->getParsedBody();

        $mail->addAddress = $datapost['To'];
        $mail->subject = $datapost['Subject'];
        $mail->body = $datapost['Message'];
        $mail->isHtml = $datapost['Html'];
        $mail->setFrom = $datapost['From'];
        $mail->setFromName = $datapost['FromName'];
        $mail->addReplyTo = $datapost['ReplyTo'];
        $mail->addReplyToName = $datapost['ReplyToName'];
        
        $body = $response->getBody();
        $body->write($mail->send());
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type','application/json; charset=utf-8')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withBody($body);
    });