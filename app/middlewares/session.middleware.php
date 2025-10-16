<?php
class SessionMiddleware {
    public function run($request) {
        if (isset($_SESSION['USER_ID'])) {
            $request->user = new StdClass();
            $request->user->id_user = $_SESSION['USER_ID'];
            $request->user->user = $_SESSION['USER_NAME'];   
        } else {
            $request->user = null;
        }
        return $request;
    }
}
