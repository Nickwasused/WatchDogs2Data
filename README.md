# WatchDogs2Data
Watch Dogs 2 Data

## What the project does
This Project is made to help Watch Dogs 2 mod developers find the correct data for their project, e.g. the correct character model or vehicle.

## Why the project is useful
The Project is useful because there is no other site (that I know, please correct me if I am wrong!) that offers a list of all character models, vehicles, weather types, or LMA layers (all with previews).
   
## How users can get started with the project
You can visit the Project at [https://watchdogs2.nickwasused.com](https://watchdogs2.nickwasused.com) or build it yourself with [python3](https://www.python.org/download/releases/3.0/) and [hugo](https://gohugo.io/).

## Build Instructions

1. Install [python3](https://www.python.org/download/releases/3.0/) and [hugo](https://gohugo.io/)
2. Generate all necessary files by running: ```python3 build.py```
3. After that run: ````hugo``` to build the site

### Cloudflare Pages

For a deployment to Clouflare pages please to the following:
- add Enviroment variable: ```HUGO_VERSION```=```0.93.3```
- add Enviroment variable: ```PYTHON_VERSION```=```3.7```
- Framework: ```None```
- Build command: ```python build.py && hugo```
- Build Output directory: ```public```