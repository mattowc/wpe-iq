<?php
if (!defined('IPHORM_VERSION')) exit;

$newline = iphorm_get_email_newline();
echo $mailer->Subject . $newline . $newline;

foreach ($form->getElements() as $element) {
    if (!$element->isHidden() && (!$element->isEmpty() || ($element->isEmpty() && $form->getNotificationShowEmptyFields()))) {
        echo $element->getAdminLabel() . $newline;
        echo '------------------------' . $newline;
        echo $element->getValuePlain();

        echo $newline . $newline;
    }
}