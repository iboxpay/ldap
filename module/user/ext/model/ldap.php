function identify($account, $password) 
{
        if(!$account or !$password) return false;

	/* Authenticate with LDAP */ 
	$this->app->loadClass('ldap',true);
	if(!ldap_authenticate_by_username($account,$password)) {
		return false;
	}
        /* Get the user from database without check password condition.  */
        $user = $this->dao->select('*')->from(TABLE_USER)
            ->where('account')->eq($account)
            ->andWhere('deleted')->eq(0)
            ->fetch();


        if($user)
        {
            $ip   = $this->server->remote_addr;
            $last = $this->server->request_time;
            $this->dao->update(TABLE_USER)->set('visits = visits + 1')->set('ip')->eq($ip)->set('last')->eq($last)->where('account')->eq($account)->exec();
            $user->last = date(DT_DATETIME1, $user->last);
        }
        return $user;
}
