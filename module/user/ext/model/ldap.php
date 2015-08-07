/* vim: set expandtab sw=4 ts=4 sts=4: */

function identify($account, $password)
{
    if(!$account or !$password) return false;

    /* admin account skip  LDAP  Authenticate */
    if ($account == "admin") {
        $record = $this->dao->select('*')->from(TABLE_USER)
                        ->where('account')->eq($account)
                        ->beginIF(strlen($password) < 32)->andWhere('password')->eq(md5($password))->fi()
                        ->andWhere('deleted')->eq(0)
                        ->fetch();

        /* If the length of $password is 32 or 40, checking by the auth hash. */
        $user = false;

        if ($record) {
            $passwordLength = strlen($password);
            if ($passwordLength < 32) {
                $user = $record;
            } elseif ($passwordLength == 32) {
                $hash = $this->session->rand ? md5($record->password . $this->session->rand) : $record->password;
                $user = $password == $hash ? $record : '';
            } elseif ($passwordLength == 40) {
                $hash = sha1($record->account . $record->password . $record->last);
                $user = $password == $hash ? $record : '';
            }

            $ip   = $this->server->remote_addr;
            $last = $this->server->request_time;
            $this->dao->update(TABLE_USER)->set('visits = visits + 1')->set('ip')->eq($ip)->set('last')->eq($last)->where('account')->eq($account)->exec();
            $user->last = date(DT_DATETIME1, $user->last);
        }

        return $user;
    }

    /* Authenticate with LDAP */
    $this->app->loadClass('ldap', true);
    if (!ldap_authenticate_by_username($account, $password)) {
        return false;
    }

    /* Get the user from database without check password condition.  */
    $user = $this->dao->select('*')->from(TABLE_USER)
                    ->where('account')->eq($account)
                    ->andWhere('deleted')->eq(0)
                    ->fetch();


    if ($user) {
        $ip   = $this->server->remote_addr;
        $last = $this->server->request_time;
        $this->dao->update(TABLE_USER)->set('visits = visits + 1')->set('ip')->eq($ip)->set('last')->eq($last)->where('account')->eq($account)->exec();
        $user->last = date(DT_DATETIME1, $user->last);
    }

    return $user;
}

