
// Always add the 'table' class to new tables in the Gutenberg editor
function ngiAddBlockClassNames( props, blockType ) {
    if(blockType.name == 'core/table') {
        props.children.props.className = 'table table-striped table-bordered';
        return props;
    }
    return props;
}

wp.hooks.addFilter(
    'blocks.getSaveContent.extraProps',
    'ngi-guten-extend/add-block-class-names',
    ngiAddBlockClassNames
);
