export function debounce() {
    let a = 123;
    console.log('pre', a);
    const debounced = () => {
        a++;
        console.log('posle', a);
    };
    return debounced;
}
