Vagrant::Config.run do |config|
  config.vm.box = "lucid32"
  config.vm.box_url = "http://files.vagrantup.com/lucid32.box"

  config.vm.network "33.33.33.100"
  config.vm.share_folder "v-root", "/vagrant", ".", :nfs => true
  config.ssh.forward_agent = true

  config.vm.provision :chef_client do |chef|
    chef.chef_server_url = "http://chef.adcloud.net:4000"
    chef.validation_key_path = "#{ENV['HOME']}/.chef/adcloud.pem"
    chef.validation_client_name = "adcloud"
    chef.node_name = 'vagrant-api-client-php'

    chef.environment = "development"
    chef.add_role "base"
    chef.add_recipe "php"
  end
end
