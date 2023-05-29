<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customize Page</title>
    <style>
        .locked {
            opacity: 0.5;
        }

        select:hover + .image-window {
            display: block;
        }

        .image-window img {
            display: block;
            width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Customize Page</h1>

    <label for="background-color-select">Background Color:</label>
    <select id="background-color-select" onchange="handleSelection('background-color-select')">
        <option value="red">Red</option>
        <option value="green">Green</option>
        <option value="blue">Blue</option>
    </select>

    <label for="dress-color-select">Dress Color:</label>
    <select id="dress-color-select" onchange="handleSelection('dress-color-select')">
        <option value="red">Red</option>
        <option value="green">Green</option>
        <option value="blue">Blue</option>
    </select>

    <label for="pets-select">Pets:</label>
    <select id="pets-select" onchange="handleSelection('pets-select')">
        <option value="pet1">Pet 1<img src="/cust/pet1.gif" alt="pet1" height="10px" width="10px"></option>
        <option value="pet2">Pet 2<img src="/cust/pet2.gif" alt="pet2"></option>
        <option value="pet3">Pet 3<img src="/cust/pet3.gif" alt="pet3"></option>
    </select>
    <script>
        const sumOfCoins = @json($sum);
        const minimumB = @json($minRequirement[0]);
        const minimumA = @json($minRequirement[1]);
        const minimumP = @json($minRequirement[2]);

        const customizationIds = @json($unlock);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function handleSelection(selectId) {
            const select = document.getElementById(selectId);
            const selectedValue = select.value;
            const minimumCoinRequirement = getMinimumCoinRequirement(selectId);

            if (!customizationIds.includes(minimumCoinRequirement.id) && sumOfCoins >= minimumCoinRequirement.minimum_coin) {
                const deductedCoins = sumOfCoins - minimumCoinRequirement.minimum_coin;
                if (deductedCoins > 0) {
                    fetch('/customize', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken
                        },
                        body: JSON.stringify({ coins: deductedCoins, customizationId: minimumCoinRequirement.id })
                    })
                    .then(response => {
                        console.log('Unlock status updated:', response);
                    })
                    .catch(error => {
                        console.error('Error during unlock status update:', error);
                    });
                }
            }
        }

        function getMinimumCoinRequirement(selectId) {
            switch (selectId) {
                case 'background-color-select':
                    return minimumB;
                case 'dress-color-select':
                    return minimumA;
                case 'pets-select':
                    return minimumP;
                default:
                    return null;
            }
        }

        const backgroundColorSelect = document.getElementById('background-color-select');
        if (customizationIds.includes(minimumB.id) || sumOfCoins >= minimumB.minimum_coin) {
            backgroundColorSelect.disabled = false;
        } else {
            backgroundColorSelect.disabled = true;
            backgroundColorSelect.classList.add('locked');
        }

        const dressColorSelect = document.getElementById('dress-color-select');
        if (customizationIds.includes(minimumA.id) || sumOfCoins >= minimumA.minimum_coin) {
            dressColorSelect.disabled = false;
        } else {
            dressColorSelect.disabled = true;
            dressColorSelect.classList.add('locked');
        }

        const petsSelect = document.getElementById('pets-select');
        if (customizationIds.includes(minimumP.id) || sumOfCoins >= minimumP.minimum_coin) {
            petsSelect.disabled = false;
        } else {
            petsSelect.disabled = true;
            petsSelect.classList.add('locked');
        }
    </script>
</body>
</html>
