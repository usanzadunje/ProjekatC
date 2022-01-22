/**
 * Helper file for defining different paths to backend app.
 */

export function storagePath(path: string): string {
    return `/storage/${path}`;
}

export function imgPath(path: string): string {
    return storagePath(`img/${path}`);
}

export function avatarPath(avatar: string): string {
    return imgPath(`avatars/${avatar}`);
}

export function placeImgPath(path: string): string {
    return imgPath(`places/${path}`);
}

export function placeLogoPath(placeId: number): string {
    return placeImgPath(`${placeId}/logo.png`);
}
