current_dir = $(shell pwd)

all: 
# Install the cronjob to run the script every day at 11:00 PM
# Append the cronjob to the current cronjobs
	@echo "Installing the cronjob to run the script every day at 11:00 PM"
	(crontab -l; echo -e "echo "0 23 * * * 'php $(current_dir)/index.php'"") | crontab -
	@echo "Checking crontjob syntax"
	crontab -n
	if [ $$? -eq 0 ]; then \
		echo "Cronjob syntax is correct"; \
	else \
		echo "Cronjob syntax is incorrect - quitting."; \
		exit 1; \
	fi
