<?php namespace TwswebInt\CamelotAuth;

use Illuminate\Session\Store;
use Config;

class Camelot{

    /**
     * The session store used by CamolotAuth
     *
     * @var Illuminate\Session\Store
     */
    protected $session;

    /**
     * A list of supported drivers 
     *
     * @var array
     */
    protected $supported_drivers = array();

    /**
     * Loaded Authentication Driver.
     *
     * @return void
     */
    protected $driver = null;

    public function __constructor()
    {
        echo 'loading';
        Log::info('This is some useful information.');
        $this->supported_drivers = Config::get('camolotauth::camelotauth.provider_routing');
    }

   /* public function driver($driver = null)
    {
    	if(is_null($driver)){
    		$driver = Config::get('camelotauth.default_driver');
    	}

    	if(!isset($this->drivers[$driver]))
    	{
    		$this->drivers[$driver] = $this->loadDriver($driver);
    	}
    	return $this->drivers[$driver];
    }*/

  /*  public functiondriver($driver = null)
    {
        // if driver is not null then we want to set a new loaded driver
        if(!is_null($driver) && (is_null($this->driver)) )
        {
            $this->loadDriver($driver);
        }

        if()
    }*/

    public static function loadDriver($driver = null)
    {
        // there is no driver specified lets try and detect the required driver
        if(is_null($driver))
        {
            // if detect_provider == true 
            if(Config::get('camolotauth::camelotauth.detect_provider'))
            {

            }

            // if the driver is still null lets just load the default driver
            if(is_null($driver))
            {
                $driver = Config::get('camolotauth::camelotauth.default_driver');
            }
        }

        // lets load the specified driver


        //$this->driver = new $driver_class
    }

    public function __call($method,$params)
    {
        echo "string";
        return 'bla';
        if(is_null($this->driver))
        {
            if(isset($params[0]) && isset($this->supported_drivers[ucfirst($params[0])]))
            {
                $this->loadDriver($this->supported_drivers[ucfirst($params[0])]['Driver']);
            }else{
                $this->loadDriver(); 
            }
        }

        if(method_exists($this->driver,$method))
        {
            return call_user_func_array(array($this->driver,$method), $params);
        }
    	else
        {
            //throw new Exception("the requested function is not available for the requested driver", 1);      
            return 'boer';//Response::error('555', 'the requested function is not available for the requested driver');   
        }
    }
}