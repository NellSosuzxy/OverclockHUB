<?php echo (Auth::attempt(['email'=>'admin@overclockhub.com','password'=>'Admin@OC2025','role'=>'user'])) ? 'YES' : 'NO';
