export function debounce(): any {
    let a: number = 123;
    console.log('pre', a);

    const debounced = () => {
        a++;
        console.log('posle', a);
    };

    return debounced;
}
