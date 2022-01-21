export function storagePath(path) {
    return `/storage/${path}`;
}
export function imgPath(path) {
    return storagePath(`img/${path}`);
}
export function avatarPath(avatar) {
    return imgPath(`avatars/${avatar}`);
}
export function placeImgPath(path) {
    return imgPath(`places/${path}`);
}
export function placeLogoPath(placeId) {
    return placeImgPath(`${placeId}/logo.png`);
}
