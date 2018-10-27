<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
$validator->setMinLength(8);
$validator->setHistoricCount(6);
Member::set_password_validator($validator);

/*HTMLEditor additional tools*/
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
HTMLEditorConfig::get('cms')->enablePlugins(['advlist', 'preview', 'textcolor', 'link', 'wordcount', 'colorpicker', 'hr', 'anchor', 'insertdatetime']);
HTMLEditorConfig::get('cms')->insertButtonsBefore('bold', ['undo', 'redo', 'preview', '|']);
HTMLEditorConfig::get('cms')->insertButtonsAfter('underline', ['strikethrough', 'forecolor']);
HTMLEditorConfig::get('cms')->insertButtonsAfter('unlink', ['insertdatetime', 'anchor', 'hr']);