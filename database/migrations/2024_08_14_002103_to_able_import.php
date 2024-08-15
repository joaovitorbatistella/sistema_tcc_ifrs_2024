<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\UserGroup;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $db = DB::connection("mysql")->getDatabaseName();

        DB::statement("
            ALTER TABLE $db.users AUTO_INCREMENT=100;
        ");

        $admin = User::create([
            'name' => "TCC - Administrator",
            'email' => "tcc-admin@ibiruba.ifrs.edu.br",
            'cpf' => "00000000000",
            'rg' => "0000000000",
            'password' => Hash::make(config('app.password_admin')),
        ]);

        if($admin) {
            UserGroup::create([
                'user_id'  => $admin->id,
                'group_id' => 1
            ]);
        }

        DB::statement("
            ALTER TABLE $db.append AUTO_INCREMENT=500;
        ");

        DB::statement("
            INSERT INTO $db.append (append_id,append_uid,name,user_id,type_id,public,`path`,created_at,updated_at) VALUES
                (501,'66a6868345872','ANEXO1.pdf',{$admin->id},1,1,'templates/66a308287167b/ANEXO1.pdf','2024-07-18 23:30:25.000','2024-07-18 23:30:25.000'),
                (502,'66a6871649a7c','ANEXO2.pdf',{$admin->id},1,1,'templates/66a308287167b/ANEXO2.pdf','2024-07-18 23:30:25.000','2024-07-18 23:30:25.000'),
                (503,'66a68719b36d9','ANEXO3.pdf',{$admin->id},1,1,'templates/66a308287167b/ANEXO3.pdf','2024-07-18 23:30:25.000','2024-07-18 23:30:25.000'),
                (504,'66a6871ccf01b','ANEXO4.pdf',{$admin->id},1,1,'templates/66a308287167b/ANEXO4.pdf','2024-07-18 23:30:25.000','2024-07-18 23:30:25.000'),
                (505,'66a6872116b68','ANEXO5.pdf',{$admin->id},1,1,'templates/66a308287167b/ANEXO5.pdf','2024-07-18 23:30:25.000','2024-07-18 23:30:25.000');
        ");

        $base_path = base_path();
        $storage_path = storage_path();
        echo shell_exec("sh $base_path/database/utils/copy-default-files.sh $base_path $storage_path");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
