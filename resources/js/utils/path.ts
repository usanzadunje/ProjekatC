export function storagePath(path: string): string {
    return '/storage/' + path;
}

export function avatarPath(avatar: string): string {
    return storagePath('avatars/' + avatar);
}
