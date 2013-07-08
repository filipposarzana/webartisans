<?php

    namespace Webartisans\Utilities\Libraries\UtilitiesURL;

    use \Illuminate\Support\Facades\Config as Config;
    use \Illuminate\Support\Facades\Session as Session;
    use \Illuminate\Support\Facades\Request as Request;
    use \Illuminate\Support\Facades\App as App;
    use \Illuminate\Support\Facades\URL as URL;

    class UtilitiesURL {

        /**
         * The cdn.
         *
         * @var string
         */
        protected $cdn;

        /**
         * The static.
         *
         * @var string
         */
        protected $static;

        public function __construct()
        {

            $this->cdn = '//cdn.webartisans.it';

            $this->static = URL::to('/').'/_res';

        }

        /**
         * get the static URL.
         *
         * @param  string $lang
         * @return void
         */
        public function getStatic($folder = FALSE)
        {

            return (!$folder) ? $this->static : $this->static.'/'.$folder;

        }

        /**
         * get the CDN URL.
         *
         * @param  string $lang
         * @return void
         */
        public function getCdn($folder = FALSE)
        {

            return (!$folder) ? $this->cdn : $this->cdn.'/'.$folder;

        }

    }