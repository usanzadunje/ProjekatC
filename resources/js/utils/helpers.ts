export function getRandomInt(min: number, max: number) {
    min = Math.ceil(min);
    max = Math.floor(max);

    return Math.floor(Math.random() * (max - min + 1)) + min;
}

export function removeFromArray(arr: any[], value: any) {
    arr.splice(arr.indexOf(value), 1);
}

export function addOrRemoveFromArray(arr: any[], value: any) {
    if(arr.includes(value)) {
        arr.splice(arr.indexOf(value), 1);
    }else {
        arr.push(value);
    }
}

export function pluckFromArray(arr: any[], key: any) {
    return arr.map((el) => el[key]);
}