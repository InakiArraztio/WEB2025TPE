<?php
class AuthMiddleware {
    public function run($request) {
        if ($request->user) {
            return $request;
        } else {
            header("Location: " . BASE_URL . "login");
            exit();
        }
    }
}