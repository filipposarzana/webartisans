<?php

    namespace Webartisans\Utilities\Libraries\Nav;

    use \Illuminate\Support\Facades\Config as Config;
    use \Illuminate\Support\Facades\Session as Session;
    use \Illuminate\Support\Facades\Request as Request;
    use \Illuminate\Support\Facades\App as App;
    use \Illuminate\Support\Facades\URL as URL;
    use \Illuminate\Support\Facades\Lang as Lang;
    use \Illuminate\Support\Str as Str;

    class Nav {

        /**
         * The navigation.
         *
         * @var array
         */
        protected $nav;

        /**
         * The filename.
         *
         * @var string
         */
        protected $filename;

        public function __construct()
        {

            $this->nav = array();

            $this->filename = 'nav';

        }

        /**
         * get the navigation.
         *
         * @param  string $filename
         * @return obj
         */
        public function getNav($filename = FALSE)
        {

            if ($filename)
            {

                $this->filename = $filename;

            }

            return $this->response(Lang::get($this->filename));

        }

        /**
         * get the hashed link.
         *
         * @param  string $segment
         * @return string
         */
        public function getHashedLink($segment)
        {

            return URL::to('/').'/#!/'.Str::slug($segment);

        }

        /**
         * get the navigation segment by lang.
         *
         * @param  string $segment
         * @return string
         */
        public function getNavigationSegment($segment, $filename = FALSE)
        {

            if ($filename)
            {

                $this->filename = $filename;

            }

            return Str::slug(Lang::get($this->filename.'.'.$segment.'.label'));

        }

        /**
         * is active.
         *
         * @param  string $segment
         * @return string
         */
        public function isActive($segment)
        {

            $segment = Str::slug($segment);

            if (!Request::segment(1) && $segment == 'home' || Request::segment(1) == $segment)
            {

                return TRUE;

            }

            return FALSE;

        }

        /**
         * response.
         *
         * @param  array $array
         * @return obj
         */
        public function response($array = array())
        {

            return json_decode(json_encode($array));

        }

    }