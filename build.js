const { execSync } = require('child_process');

try {
  // Install PHP and Composer
  console.log('Installing PHP and Composer...');
  execSync('curl -sS https://getcomposer.org/installer | php', { stdio: 'inherit' });
  execSync('mv composer.phar /usr/local/bin/composer', { stdio: 'inherit' });

  // Install Laravel dependencies
  console.log('Running composer install...');
  execSync('composer install --optimize-autoloader --no-dev', { stdio: 'inherit' });

  // Run Laravel commands
  console.log('Running Laravel optimization commands...');
  execSync('php artisan config:cache', { stdio: 'inherit' });
  execSync('php artisan route:cache', { stdio: 'inherit' });
  execSync('php artisan view:cache', { stdio: 'inherit' });

  console.log('Build completed successfully!');
} catch (error) {
  console.error('Error during build:', error);
  process.exit(1);
}