export function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
export function removeFromArray(arr, value) {
    arr.splice(arr.indexOf(value), 1);
}
export function addOrRemoveFromArray(arr, value) {
    if (arr.includes(value)) {
        arr.splice(arr.indexOf(value), 1);
    }
    else {
        arr.push(value);
    }
}
