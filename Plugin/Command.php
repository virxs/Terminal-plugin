<?php
function Command($vk, $cmd){
    if($cmd[0] == 'rview'){
        if($cmd[1]){
            $dialog_role = array();
            $user = Vk::User($vk->object->peer_id);
            foreach (Role::Name($cmd[1]) as $user_role){
                foreach ($user as $id){
                    if($id == $user_role) array_push($dialog_role, $id);
                }
            }
            if(count($dialog_role) > 0){
                $message = "Роль ".$cmd[1]." найдена у:\n";
                foreach(User::Names($dialog_role, 'gen') as $name){
                    $message .= '['.$name->first_name.' '.$name->last_name."]\n";
                }
                Vk::Message($message, $vk->object->peer_id);
                return true;
            }
            else{
                Vk::Message('Участников беседы с такой ролью '.cmd[1].' не найдено', $vk->object->peer_id);
                return true;
            }
        }
    }
    return false;
}