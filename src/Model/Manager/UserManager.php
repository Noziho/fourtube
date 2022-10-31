<?php

namespace App\Model\Manager;

use App\Model\DB_Connect;
use App\Model\Entity\User;

class UserManager {

    const TABLE = 'ndmp22_user';

    public static function makeUser(array $data): User
    {
        return (new User())
            ->setId($data['id'])
            ->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setPassword($data['password']);

    }

    public static function getUserById (int $user_id): ?User
    {
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE . " WHERE id = $user_id");
        return $query->execute() ? self::makeUser($query->fetch()) : null;
    }

    public static function register (string $email, string $username, string $password): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO " .self::TABLE . "(email, username, password)
            VALUES (:email, :username, :password)"
        );

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public static function login (string $email, string $password): void
    {
        $stmt = DB_Connect::dbConnect()->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :email");
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $data = $stmt->fetch();
            if (password_verify($password, $data['password'])) {
                $user = self::makeUser($data);

                if (!isset($_SESSION['current_user'])) {
                    $_SESSION['current_user'] = $user;
                }
                header("Location: /?c=home&f=SUCESS");
            }else {
                header("Location; /?c=user&a=login&f=WrongPassword");
            }
        }else {
            header("Location: /?c=home&f=GLOBALERROR");
        }
    }


}