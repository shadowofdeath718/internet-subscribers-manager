<?php
/**
*
*/
class Customer
{
    protected $subcribers_id;
    protected $name;
    protected $address;
    protected $phone_num;
    protected $plan_id;
    protected $register_date;
    protected $email;
    protected $passwd;

    function __construct(array $data)
    {
        if (isset($data['subcribers_id'])) {
            $this->subcribers_id = $data['subcribers_id'];
        }
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->phone_num = $data['phone_num'];
        $this->plan_id = $data['plan_id'];
        $this->register_date = $data['register_date'];
        $this->email = $data['email'];
        $this->passwd = $data['passwd'];
    }

    /**
     * Gets the value of subcribers_id.
     *
     * @return mixed
     */
    public function getSubcribersId()
    {
        return $this->subcribers_id;
    }

    /**
     * Sets the value of subcribers_id.
     *
     * @param mixed $subcribers_id the subcribers id
     *
     * @return self
     */
    protected function setSubcribersId($subcribers_id)
    {
        $this->subcribers_id = $subcribers_id;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    protected function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of address.
     *
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the value of address.
     *
     * @param mixed $address the address
     *
     * @return self
     */
    protected function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Gets the value of phone_num.
     *
     * @return mixed
     */
    public function getPhoneNum()
    {
        return $this->phone_num;
    }

    /**
     * Sets the value of phone_num.
     *
     * @param mixed $phone_num the phone num
     *
     * @return self
     */
    protected function setPhoneNum($phone_num)
    {
        $this->phone_num = $phone_num;

        return $this;
    }

    /**
     * Gets the value of plan_id.
     *
     * @return mixed
     */
    public function getPlanId()
    {
        return $this->plan_id;
    }

    /**
     * Sets the value of plan_id.
     *
     * @param mixed $plan_id the plan id
     *
     * @return self
     */
    protected function setPlanId($plan_id)
    {
        $this->plan_id = $plan_id;

        return $this;
    }

    /**
     * Gets the value of register_date.
     *
     * @return mixed
     */
    public function getRegisterDate()
    {
        return $this->register_date;
    }

    /**
     * Sets the value of register_date.
     *
     * @param mixed $register_date the register date
     *
     * @return self
     */
    protected function setRegisterDate($register_date)
    {
        $this->register_date = $register_date;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    protected function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of passwd.
     *
     * @return mixed
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Sets the value of passwd.
     *
     * @param mixed $passwd the passwd
     *
     * @return self
     */
    protected function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }
}
