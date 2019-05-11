<?php
function Command($vk, $cmd){
    if($cmd[0] == 'rview') {
        if($cmd[1]){
            if(!$role = Role::Name($cmd[1])){
                Vk::Message('Участников беседы с ролью <'.$cmd[1].'> не найдено', $vk->object->peer_id);
                return true;
            }
            foreach($user = Vk::User($vk->object->peer_id) as $k => $id){
                if(!in_array($id, $role)) unset($user[$k]);
            }
            $user = array_values($user);
            $message = "Роль ".$cmd[1]." найдена у:\n";
            foreach(User::Names($user, 'gen') as $name){
                $message .= '['.$name->first_name.' '.$name->last_name."]\n";
            }
                Vk::Message($message, $vk->object->peer_id);
                return true;
        }
    }
    return false;
}