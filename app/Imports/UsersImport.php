<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            //student id,username, name , email , alias, password
            'stdid'=>$row[0],
            'username'=>$row[1],
            'name'=>$row[2],
            'email'=>$row[3],
            'alias'     => $row[4], 
           'password' => Hash::make($row[5]),
        ]);
    }
}
