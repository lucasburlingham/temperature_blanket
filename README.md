# Temperature Logger

Logs the max temperature of the day to a Google Form, which spits it out into a Google Sheet.

## Setup

1. Create a Google Sheets file and open it. In the toolbar, go to "Tools" and select "Create new form". This will create a Google Form that is linked to the Google Sheet. Open that form and create two questions with the following types:

   - Temperature (short answer)
   - Date (date)

2. Put your Google Form URL in a file named `.GOOGLE_FORMS_URL` in the root directory, changing `/viewForm` to `/formResponse`.
    - To find the URL of your form, use this guide:
[How to: Use curl to submit Google Form](https://dannyda.com/2020/02/19/how-to-use-curl-to-submit-google-form/). *Refer to this guide again when getting the entry IDs for the form.*

3. Signup for a free account at [OpenWeatherMap](https://openweathermap.org/) and get an API key. Put this key in a file named `.OPENWEATHERMAP_API_KEY` in the root directory.

4. *(OPTIONAL)* Run `make` to install the cron job that will run the script every day at 2300 (11:00 PM). 

	*(Why not 12AM or midnight? Because the max temperature of the day is usually recorded in the afternoon, and if one were to run it at midnight, the request would be for sometime after midnight, effectively the next day, which may or may not be an issue for you. If the max temperature occurs after 11PM, you've got greater issues on hand, and probably should flee the country.)*

> [!CAUTION]
> Be mindful that if you publicaly expose the site to the internet, anyone can  
> see your API key and submit data to your Google Form.  
> You are on your own if you expose your API key to the public.  
