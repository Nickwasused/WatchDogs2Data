# Scripthook guide/tweaks

### LoadLMALayer

```
LoadLMALayer(name, "0", loadingstate, function()end, "")
```
name: This is the name of the LMYLayer you want to load.
"0": not known
loadingstate: If 0: When you load a LoadLMALayer every other one is getting unloaded e.g. shops. If it is 1 then you can load unlimited LMALayers (maybe causing performance issues). 

#### Example command
```
LoadLMALayer("temp_playgo_hma", "0", 1, function()end, "")
```
or
```
LoadLMALayer("shuffler_minute_02_progression", "0", 0, function()end, "")
```