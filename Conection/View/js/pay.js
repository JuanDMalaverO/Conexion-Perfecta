document.getElementById('card-input').addEventListener('input', function (e) {
    let input = e.target;
    let value = input.value.replace(/\D/g, '');
    let formattedValue = '';
    
    for (let i = 0; i < value.length; i += 4) {
        if (i > 0) {
            formattedValue += '-';
        }
        formattedValue += value.substring(i, i + 4);
    }
    
    input.value = formattedValue;
});

document.getElementById('date-input').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 2) {
        value = value.slice(0, 2) + '/' + value.slice(2, 4);
    }
    e.target.value = value;
});

document.getElementById('cvv-input').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/\D/g, '');
});
