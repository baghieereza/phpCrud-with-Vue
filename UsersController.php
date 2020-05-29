<?php

require_once '../User.php';

class UsersController {

    /**
     * get all user
     * @param \models\UsersInterface $users
     */

    public  function read()
    {
        $users = new User();
        $data = $users->read();
        echo json_encode($data);
    }

    /**
     * crate new user
     * @param                        $data
     * @param \models\UsersInterface $users
     */
    public static function create($data)
    {
        $users = new User();
        $data = $users->create($data);
        echo json_encode($data);
    }

    /**
     * update user
     * @param                        $id
     * @param                        $data
     * @param \models\UsersInterface $users
     */
    public static function update($id, $data)
    {
        unset($data[0],$data[1],$data[2],$data[3],$data['id']);
         $users = new User();
        $data = $users->update($id , $data);
        echo  json_encode($data);
    }

    /**
     * @param                        $id
     * @param \models\UsersInterface $users
     */
    public static function delete($id)
    {
        $users = new User();
        $data =  $users->delete($id);
       echo json_encode($data);
    }

}
