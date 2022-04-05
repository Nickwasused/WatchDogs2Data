import os

def loadjson(file):
    from json import load
    f = open(file, encoding="utf8")
    return load(f)

builddata = [
    {
        "filename": "2022-01-01-characters.markdown",
        "source": "characters.json",
        "title": "Characters",
        "category": "characters",
        "categories": "watch-dogs2 watch-dogs characters models character-list",
        "description": "A list of every Character Model in Watch Dogs 2 with Images."
    },
    {
        "filename": "2022-01-01-lmalayers.markdown",
        "source": "lmalayers.json",
        "title": "LMA Layers",
        "category": "lmalayers",
        "categories": "watch-dogs2 watch-dogs lmalayers lma layers",
        "description": "A list of every LMA-Layer in Watch Dogs 2."
    },
    {
        "filename": "2022-01-01-vehicles.markdown",
        "source": "vehicles.json",
        "title": "Vehicles",
        "category": "vehicles",
        "categories": "watch-dogs2 watch-dogs vehicles vehicle-list",
        "description": "A list of every Vehicle Model in Watch Dogs 2 with Images."
    },
    {
        "filename": "2022-01-01-weather.markdown",
        "source": "weather.json",
        "title": "Weather",
        "category": "weather",
        "categories": "watch-dogs2 watch-dogs weather weather-showcase weather-list",
        "description": "A list of every Weather Type in Watch Dogs 2 with Videos."
    }
]

example_header = """---
layout: post
title:  "{}"
date:   2022-01-01 00:00:01 +0000
categories: {}
description: "{}"
---
"""

table_basic = """| ID | Name | Image/Video
| - | - | ----------
"""

table_basic_loc = """| ID | Name | Image/Video | Location
| - | - | ---------- | - 
"""

table_empty_row = """| | | """
table_empty_row_loc = """| | | """

lozad_video = """<video controls width="100%" class="lozad"><source data-src="{}" type="video/webm" /><source data-src="{}" type="video/mp4" /></video>"""

lozad_image = """<img class="lozad" data-src="/images/webp/{}/{}.webp" />"""

for data in builddata:
    build_json = loadjson("./source_data/{}".format(data["source"]))

    with open("./content/{}/_index.md".format(data["category"]), "w+", encoding="utf-8") as f:

        site_data = []
        for item in build_json:
            site_data.append(item["name"])

        f.write(example_header.format(data["title"], data["categories"], data["description"]))

        if (data["category"] == "lmalayers"):
            f.write(table_basic_loc)
        else:
            f.write(table_basic)

        for item in build_json:
            save_image = ""
            try:
                if (item["image"] == "1"):
                    save_image = lozad_image.format(data["category"], item["name"].lower())
            except KeyError:
                pass

            try:
                if (item["weathervideo"] == "1"):
                    save_image = lozad_video.format("/videos/webm/{}/{}.webm".format(data["category"], item["name"]), "/videos/mp4/{}/{}.mp4".format(data["category"], item["name"])) 
            except KeyError:
                pass

            location = ""
            try:
                if (item["location"] != ""):
                    location = item["location"]
            except KeyError:
                pass

            if (data["category"] == "lmalayers"):
                f.write("| {} | {} | {} | {}\n".format(item["id"], item["name"], save_image, location))
            else:
                f.write("| {} | {} | {}\n".format(item["id"], item["name"], save_image))

        f.write(table_empty_row)
        f.close()
