class php56 {
  $enhancers = [
    'php5-fpm',
    'php5-cli',
    'php5-curl',
    'php5-mongo',
  ]

  include apt

  apt::ppa { 'ppa:ondrej/php': }

  exec { "apt-get update php56":
    command => "/usr/bin/apt-get update",
    require => Apt::Ppa['ppa:ondrej/php']
  }->

  package { $enhancers: ensure  => 'installed',install_options => ['-y', '--force-yes'],require  => Exec['apt-get update php56'], }

  file { "/etc/php5/fpm/pool.d/www.conf":
    path => "/etc/php5/fpm/pool.d/www.conf",
    content => template('php56/php-fpm-www.conf.erb'),
    require => Package[$enhancers],
    notify => Service['php5-fpm']
  }
  file { "/etc/php5/fpm/php.ini":
    path => "/etc/php5/fpm/php.ini",
    content => template('php56/php-fpm.ini.erb'),
    require => Package[$enhancers],
    notify => Service['php5-fpm']
  }
  file { "/etc/php5/fpm/php-fpm.conf":
    path => "/etc/php5/fpm/php-fpm.conf",
    content => template('php56/php-fpm.conf.erb'),
    require => Package[$enhancers],
    notify => Service['php5-fpm']
  }

  service { 'php5-fpm':
    ensure  => 'running',
    enable  => true,
    require => Package[$enhancers],
  }
}
