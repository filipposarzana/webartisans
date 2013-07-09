<?php

    namespace Webartisans\Utilities\Libraries\Language;

    use \Illuminate\Support\Facades\Config as Config;
    use \Illuminate\Support\Facades\Session as Session;
    use \Illuminate\Support\Facades\Request as Request;
    use \Illuminate\Support\Facades\App as App;

    class Language {

    	/**
		 * The current language.
		 *
		 * @var string
		 */
        protected $lang;

        /**
         * The current package.
         *
         * @var string
         */
        protected $package;

        /**
         * The current prefix.
         *
         * @var string
         */
        protected $prefix;

        /**
		 * Create a new language.
		 *
		 * @param  \Cms\Laravelcms\Libraries\Language  $lang
		 * @return void
		 */
        public function __construct()
        {

        	$this->package = 'utilities';
            
            $this->lang = Config::get($this->package.'::language.language');
            
            $this->prefix = NULL;

            $languages = Config::get($this->package.'::language.available');

        }

        /**
		 * Set the new language.
		 *
		 * @param  string $lang
		 * @return void
		 */
        public function set($lang)
        {

        	$this->lang = $lang;

        	Session::put('language', $lang);
            
            App::setLocale($lang);

        }

        /**
		 * Get the new language.
		 *
		 * @return string $lang
		 */
        public function get()
        {

        	return $this->lang;

        }

        /**
         * Detect the new language.
         *
         * @return void
         */
        public function detect()
        {

            if (in_array(Request::segment(1), Config::get($this->package.'::language.languages')))
            {

                $this->set(Request::segment(1));

            }
            else
            {

                if (!Session::has('language'))
                {

                    $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';

                    $browser_lang = substr($browser_lang, 0,2);

                    $this->lang = in_array($browser_lang, Config::get($this->package.'::language.languages')) ? $browser_lang : Config::get($this->package.'::language.language');

                    $this->set($this->lang);

                }
                else
                {

                    $this->set(Session::get('language'));

                }

            }

        }

        /**
         * Detect if the first segment is a language and set as a prefix for routes.
         *
         * @return string $prefix
         */
        public function prefix()
        {

            if (in_array(Request::segment(1), Config::get($this->package.'::language.languages')))
            {

                $this->prefix = Request::segment(1);

            }
            else
            {

                $this->prefix = NULL;

            }

            return $this->prefix;

        }

    }