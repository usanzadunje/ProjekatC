export function storagePath(path) {
    return `/storage/${path}`;
}
export function avatarPath(avatar) {
    return storagePath(`avatars/${avatar}`);
}
export function placeLogoPath(placeName) {
    return storagePath(`${placeName}/avatar.png`);
}
