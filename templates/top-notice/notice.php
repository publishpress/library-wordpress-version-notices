<?php
$linkStart = '<a href="' . $linkURL . '" target="_blank">';
$linkEnd   = '</a>';
$message   = sprintf($message, $linkStart, $linkEnd);
?>
<div class="pp-version-notice-bold-purple">
    <span class="pp-version-notice-bold-purple-message"><?php echo $message; ?></span>
</div>