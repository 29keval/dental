<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teeth Diagram</title>
    <style>
        .teeth-diagram {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .tooth {
            width: 50px;
            height: 50px;
            background-color: #f0f0f0;
            margin: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            border: 1px solid #000;
            cursor: pointer;
        }
        .tooth.selected {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<h2>Select Tooth to Add a Problem</h2>
<div class="teeth-diagram">
    <!-- Upper Right -->
    <div id="tooth18" class="tooth" onclick="selectTooth(18)">18</div>
    <div id="tooth17" class="tooth" onclick="selectTooth(17)">17</div>
    <div id="tooth16" class="tooth" onclick="selectTooth(16)">16</div>
    <div id="tooth15" class="tooth" onclick="selectTooth(15)">15</div>
    <div id="tooth14" class="tooth" onclick="selectTooth(14)">14</div>
    <div id="tooth13" class="tooth" onclick="selectTooth(13)">13</div>
    <div id="tooth12" class="tooth" onclick="selectTooth(12)">12</div>
    <div id="tooth11" class="tooth" onclick="selectTooth(11)">11</div>
    
    <!-- Upper Left -->
    <div id="tooth21" class="tooth" onclick="selectTooth(21)">21</div>
    <div id="tooth22" class="tooth" onclick="selectTooth(22)">22</div>
    <div id="tooth23" class="tooth" onclick="selectTooth(23)">23</div>
    <div id="tooth24" class="tooth" onclick="selectTooth(24)">24</div>
    <div id="tooth25" class="tooth" onclick="selectTooth(25)">25</div>
    <div id="tooth26" class="tooth" onclick="selectTooth(26)">26</div>
    <div id="tooth27" class="tooth" onclick="selectTooth(27)">27</div>
    <div id="tooth28" class="tooth" onclick="selectTooth(28)">28</div>

    <!-- Lower Left -->
    <div id="tooth48" class="tooth" onclick="selectTooth(48)">48</div>
    <div id="tooth47" class="tooth" onclick="selectTooth(47)">47</div>
    <div id="tooth46" class="tooth" onclick="selectTooth(46)">46</div>
    <div id="tooth45" class="tooth" onclick="selectTooth(45)">45</div>
    <div id="tooth44" class="tooth" onclick="selectTooth(44)">44</div>
    <div id="tooth43" class="tooth" onclick="selectTooth(43)">43</div>
    <div id="tooth42" class="tooth" onclick="selectTooth(42)">42</div>
    <div id="tooth41" class="tooth" onclick="selectTooth(41)">41</div>

    <!-- Lower Right -->
    <div id="tooth31" class="tooth" onclick="selectTooth(31)">31</div>
    <div id="tooth32" class="tooth" onclick="selectTooth(32)">32</div>
    <div id="tooth33" class="tooth" onclick="selectTooth(33)">33</div>
    <div id="tooth34" class="tooth" onclick="selectTooth(34)">34</div>
    <div id="tooth35" class="tooth" onclick="selectTooth(35)">35</div>
    <div id="tooth36" class="tooth" onclick="selectTooth(36)">36</div>
    <div id="tooth37" class="tooth" onclick="selectTooth(37)">37</div>
    <div id="tooth38" class="tooth" onclick="selectTooth(38)">38</div>
</div>

<!-- A form or section where problems for selected tooth will be shown -->
<div id="selectedToothInfo" style="margin-top: 20px;">
    <h3>Selected Tooth: <span id="selectedTooth"></span></h3>
    <label for="problem">Select Problem:</label>
    <select id="problem">
        <option value="Cavity Level 1">Cavity Level 1</option>
        <option value="Cavity Level 2">Cavity Level 2</option>
        <option value="Cavity Level 3">Cavity Level 3</option>
        <option value="Root Canal Needed">Root Canal Needed</option>
        <option value="Fractured Tooth">Fractured Tooth</option>
    </select>
    <button onclick="saveProblem()">Save Problem</button>
</div>

<script>
    let selectedTooth = null;

    function selectTooth(toothNumber) {
        // Clear any previous selection
        if (selectedTooth) {
            document.getElementById('tooth' + selectedTooth).classList.remove('selected');
        }

        // Select the new tooth
        selectedTooth = toothNumber;
        document.getElementById('tooth' + toothNumber).classList.add('selected');
        document.getElementById('selectedTooth').textContent = toothNumber;
    }

    function saveProblem() {
        const problem = document.getElementById('problem').value;
        if (selectedTooth) {
            alert('Problem for Tooth ' + selectedTooth + ': ' + problem + ' saved!');
            // You can extend this by saving to a database
        } else {
            alert('Please select a tooth first.');
        }
    }
</script>

</body>
</html>
